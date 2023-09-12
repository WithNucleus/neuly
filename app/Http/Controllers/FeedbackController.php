<?php

namespace App\Http\Controllers;

use App\Helpers\NotificationHelper;
use App\Http\Requests\FeedbackApiRequest;
use App\Http\Requests\FeedbackDemoRequest;
use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use App\Notifications\DemoRequestNotification;
use App\Notifications\FeedbackCreated;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(FeedbackRequest $request)
    {
        $this->storeFeedback($request->validated());

        return view('feedback.finish');
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function apiStore(FeedbackApiRequest $request)
    {
        $feedback = $this->storeFeedback($request->validated());

        return response($feedback, 200);
    }

    /**
     * @return \App\Models\Feedback
     */
    private function storeFeedback($requestData)
    {
        $feedback = new Feedback();
        $feedback->title = $requestData['title'];
        $feedback->type = $requestData['type'];
        $feedback->content = $requestData['content'];

        if (! Auth::user()) {
            $feedback->user_name = $requestData['user_name'];
            $feedback->user_email = $requestData['user_email'];
        } else {
            $feedback->user_id = Auth::user()->id;
        }

        if (isset($data['url'])) {
            $feedback->url = $requestData['url'];
        }

        $feedback->save();

//        NotificationHelper::sendAdminNotifications(new FeedbackCreated($feedback));

        return $feedback;
    }

    public function createDemoRequest(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('feedback.demo-request');
    }

    public function storeDemoRequest(FeedbackDemoRequest $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $requestData = $request->validated();

        $demoRequest = new Feedback();
        $demoRequest->organization = $requestData['organization'];
        $demoRequest->job_title = $requestData['job_title'];
        $demoRequest->type = Feedback::TYPE_DEMO_REQUEST;
        $demoRequest->title = 'Demo Request - '.$requestData['organization'];
        $demoRequest->content = $requestData['content'];

        if (! Auth::user()) {
            $demoRequest->user_name = $requestData['name'];
            $demoRequest->user_email = $requestData['email'];
        } else {
            $demoRequest->user_id = Auth::id();
        }

        $demoRequest->save();

        NotificationHelper::sendSalesNotifications(new DemoRequestNotification($demoRequest));

        return view('feedback.demo-thanks');
    }
}
