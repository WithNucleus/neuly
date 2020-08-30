<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackApiRequest;
use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function create()
    {
        return view('feedback.create');
    }

    public function store(FeedbackRequest $request)
    {
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
        return view('feedback.finish');
    }

    public function apiStore(FeedbackApiRequest $request)
    {
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

        return response('test', 200);
    }
}
