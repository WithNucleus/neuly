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
        // Auth and Permission Middleware
        $this->middleware('auth');
        $this->middleware(['role:Admin','permission:import']);
    }

    // Form for Starting an Import
    public function start() {
        $focusCats = Focus::drugs()->orderBy('name')->get();

        return view('admin.import.research', compact('focusCats'));
    }

    // Search the Research API -- NO SAVING YET
    public function search(Request $request) {

        $validated = $request->validate([
            'focus_id' => 'required|integer',
            'api' => 'required|string',
        ]);

        // Get API Resource IDs to Compare to Results
        $current_research = Research::pluck('api_identifier')->toArray();

        $api = $request->input('api');

        // Get name of Focus
        $focus = Focus::findOrFail($request->input('focus_id'));

        // Search Google Scholar
        if ($request->input('api') == 'Google Scholar') {

            // If This is a Paginated Link or Not
            if ($request->input('serpapi_pagination')) {

                // Paginated Search
                $next_link = explode('&start=', $request->input('serpapi_pagination'));

                $api_results = ResearchAPI::googleScholar(strtolower($focus->name), $next_link[1]);

            } else {

                // New Search
                $api_results = ResearchAPI::googleScholar(strtolower($focus->name));

            }

        }

        return view('admin.import.process-research', compact('api_results', 'focus', 'api' ,'current_research'));

    }

    // Import Selected Items
    public function import(Request $request) {

        // Get Selected Items
        $selected_items = $request->input('import');

        $import_results = array();

        $focus_id = $request->input('focus_id');

        foreach($selected_items as $key => $api_identifier) {

            // Find the Details for this $api_identifier
            $this_listing = $request->input($api_identifier);

            $result = json_decode($this_listing);

            // This Item's Import Results
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

                        // Find or Create Author
                        $person = Person::findOrCreatePerson($author->name, $author->link);

                        if ($person) {

                            // Attach
                            $research->people()->syncWithoutDetaching($person->id);

                            $this_import_results['authors'] = 'Attached authors';

                        } else {

                            // throw error to user person wasn't attached
                            $this_import_results['authors'] = 'Error creating authors';

                        }

                    }
                }

            } else {

                $this_import_results['model_id'] = 'Error creating record';
                $this_import_results['status'] = 'danger';

            }

            // Push to Results Array
            array_push($import_results, $this_import_results);


        } // endforeach selected_item

        // dd($import_results);

        // Has next search link?
        if ($request->input('serpapi_pagination')) {
            $next_link = $request->input('serpapi_pagination');
        }

        $info = array(
            'next_link' => $next_link,
            'import_results' => $import_results,
            'focus_id' => $focus_id
        );

        // return view('admin.import.research', compact('import_results', 'next_link', 'focus_id'));
        return redirect()->route('import.research')->with(
            'info', $info
        );

    }

}
