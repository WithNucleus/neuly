<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackApiRequest;
use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('feedback.create');
    }

    /**
     * @param \App\Http\Requests\FeedbackRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(FeedbackRequest $request)
    {
        $this->storeFeedback($request->validated());

        return view('feedback.finish');
    }

    /**
     * @param \App\Http\Requests\FeedbackApiRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function apiStore(FeedbackApiRequest $request)
    {
        $feedback = $this->storeFeedback($request->validated());

        return response($feedback, 200);
    }

    /**
     * @param $requestData
     * @return \App\Models\Feedback
     */
    private function storeFeedback($requestData)
    {
        $feedback          = new Feedback();
        $feedback->title   = $requestData['title'];
        $feedback->type    = $requestData['type'];
        $feedback->content = $requestData['content'];

        if (!Auth::user()) {
            $feedback->user_name  = $requestData['user_name'];
            $feedback->user_email = $requestData['user_email'];
        } else {
            $feedback->user_id = Auth::user()->id;
        }

        if (isset($data['url'])) {
            $feedback->url = $requestData['url'];
        }

        $feedback->save();

        return $feedback;
    }
}
