<?php

namespace App\Http\Controllers\Enterprise;

use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Enterprise\WidgetRequest;
use App\Models\Feedback;
use App\Notifications\EnterpriseWidgetNotification;
use App\Notifications\FeedbackCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardRequestsController extends Controller
{
    public function requestWidget(WidgetRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();

        $feedback = new Feedback();
        $feedback->type = Feedback::TYPE_ENTERPRISE_REQUEST;
        $feedback->title = 'Enterprise Widget Request';
        $feedback->user_id = $user->id;
        $feedback->user_name = $user->full_name;
        $feedback->user_email = $user->email;
        $feedback->content = $request->input('content');
        $feedback->save();

        NotificationHelper::sendSalesNotifications(new EnterpriseWidgetNotification($feedback));

        return response()->json([
            'status' => 'success',
            'message' => 'Your request has been sent. Thank you!'
        ]);
    }


    public function clinicalTrialParticipating(WidgetRequest $request)
    {
        $user = auth()->user();
        $feedback = new Feedback();
        $feedback->type = Feedback::TYPE_CT_PARTICIPATING;
        $feedback->title = 'Clinical Trial Participating Request';
        $feedback->user_id = $user->id;
        $feedback->user_name = $user->full_name;
        $feedback->user_email = $user->email;
        $feedback->content = $request->input('content');
        $feedback->save();

        NotificationHelper::sendAdminNotifications(new FeedbackCreated($feedback));

        return response()->json([
            'status' => 'success',
            'message' => 'Your request has been sent. Thank you!'
        ]);
    }
}
