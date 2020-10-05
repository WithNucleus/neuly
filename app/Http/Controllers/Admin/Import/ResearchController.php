<?php

namespace App\Http\Controllers\Admin\Import;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImportResult;
use Auth;
use App\ResearchAPI;
use App\Models\Focus;
use App\Models\Research;
use App\Models\Person;

class ResearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:Admin','permission:import']);
    }

    // Form for Starting an Import
    public function start() {
        $focusCats = Focus::drugs()->orderBy('name')->get();
        return view('admin.import.research', compact('focusCats'));
    }

    // Search the Research API
    public function search(Request $request) {

        $validated = $request->validate([
            'focus_id' => 'required|integer',
            'api' => 'required|string',
            'search_term' => 'nullable|string'
        ]);

        $current_research = Research::pluck('slug', 'api_identifier')->toArray();

        $api = $request->input('api');

        $focus = Focus::findOrFail($request->input('focus_id'));

        if ($request->input('search_term') != '') {
            $search_term = $request->input('search_term');
        } else {
            $search_term = strtolower($focus->name);
        }

        // Google Scholar
        if ($request->input('api') == 'Google Scholar') {

            if ($request->input('serpapi_pagination')) {

                $next_link = explode('&start=', $request->input('serpapi_pagination'));

                $api_results = ResearchAPI::googleScholar($search_term, $next_link[1]);

            } else {

                $api_results = ResearchAPI::googleScholar($search_term);

            }

        }

        return view('admin.import.process-research', compact('api_results', 'focus', 'api' ,'current_research', 'search_term'));

    }

    // Import Selected Items
    public function import(Request $request) {

        $selected_items = $request->input('import');

        $import_results = array();

        $focus_id = $request->input('focus_id');

        foreach($selected_items as $key => $api_identifier) {

            $this_listing = $request->input($api_identifier);

            $result = json_decode($this_listing);

            $this_import_results = array(
                'title' => $result->title,
                'api_identifier' => $result->result_id,
                'authors' => '',
                'model_id' => '',
                'status' => ''
            );

            $attributes = array(
                'name' => $result->title,
                'abstract' => $result->snippet,
                'link' => $result->link,
                // 'publish_date' => '',
                'publication_info' => $result->publication_info->summary,
                'api_identifier' => $result->result_id,
            );

            // If Has Resources
            if (property_exists($result, 'resources')) {
                $attributes['resources'] = json_encode($result->resources, true);
            }

            // Create a Research Item
            $research = Research::create($attributes);

            if ($research) {

                $this_import_results['model_id'] = $research->id;
                $this_import_results['status'] = 'success';
                $research->focus()->syncWithoutDetaching($focus_id);

                // If Has Authors
                if (property_exists($result->publication_info, 'authors')) {

                    foreach ($result->publication_info->authors as $author) {

                        $person = Person::findOrCreatePerson($author->name, $author->link);

                        if ($person) {

                            $research->people()->syncWithoutDetaching($person->id);

                            $this_import_results['authors'] = 'Attached authors';

                        } else {

                            $this_import_results['authors'] = 'Error creating authors';

                        }

                    }
                }

            } else {

                $this_import_results['model_id'] = 'Error creating record';
                $this_import_results['status'] = 'danger';

            }

            array_push($import_results, $this_import_results);

        }

        if ($request->input('serpapi_pagination')) {
            $next_link = $request->input('serpapi_pagination');
        }

        $info = array(
            'next_link' => $next_link,
            'import_results' => $import_results,
            'focus_id' => $focus_id
        );

        return redirect()->route('import.research')->with(
            'info', $info
        );

    }

}
