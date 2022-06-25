<?php

namespace App\Http\Controllers\Enterprise;

use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Enterprise\WidgetRequest;
use App\Models\Feedback;
use App\Notifications\EnterpriseWidgetNotification;
use Illuminate\Support\Facades\Auth;

class RequestWidgetController extends Controller
{
    public function requestWidget(WidgetRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();

        $feedback = new Feedback();
        $feedback->type = 'enterprise request';
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
}
