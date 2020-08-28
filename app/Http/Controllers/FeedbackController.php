<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        //show list of users feedback
        // probably should be postponed
    }

    public function show()
    {
        //show certain of users feedback entities
        // probably should be postponed
    }

    public function create()
    {
        return view('feedback.create');
    }

    public function store(FeedbackRequest $request)
    {
        //dd($request->all());

        $data = $request->validated();

        $feedback = new Feedback();
        $feedback->title = $data['title'];
        $feedback->type = $data['type'];
        $feedback->content = $data['content'];

        if(!Auth::user()) {
            $feedback->user_name = $data['user_name'];
            $feedback->user_email = $data['user_email'];
        } else {
            $feedback->user_id = Auth::user()->id;
        }

        $feedback->save();
        //show feedback page
    }

    public function edit()
    {
        //show form for editing a given feedback
        // probably should be postponed
    }

    public function update()
    {
        //validate request
        //store updated feedback
        //show feedback page
        // probably should be postponed
    }

    public function delete()
    {
        //delete the feedback
        //show feedback page
        // probably should be postponed
    }
}
