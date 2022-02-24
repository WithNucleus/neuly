<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\SearchTemplateRequest;
use App\Models\SearchTemplate;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SearchTemplateController extends Controller
{

    protected const TYPES = [
        "Companies",
        "People",
        "Investors",
        "Research",
        "Clinicaltrials",
        "Events",
        "Jobs"
    ];

    public function apiStore(SearchTemplateRequest $request)
    {
        $data = $request->validated();

        $template = new SearchTemplate();
        $template->name = $data['name'];
        $template->link = $data['link'];
        $template->type = $data['type'];
        $template->user_id = $data['user_id'];
        $template->description = $data['description'];
        $template->save();

        return response($template, 200);
    }

    public function index(Request $request)
    {
        $templates = SearchTemplate::where('user_id', '=', Auth::id())->get();
        $types = self::TYPES;

        return view('search.templates.index', compact('templates', 'types'));
    }

    public function update(SearchTemplate $template, Request $request)
    {
        $data = $request->all();
        //ToDo Validation
        //ToDo: Error output

        if($data !== [])
        {
            $template->name = $data['name'];
            $template->type = $data['type'];
            $template->description = $data['description'];
            $template->save();
        }

        return view('search.templates.update', compact('template', 'types'));
    }

    public function delete(SearchTemplate $template, Request $request)
    {
        $template->delete();
        return redirect()->route('user.search.templates.index');
    }

}
