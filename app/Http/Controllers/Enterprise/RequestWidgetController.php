<?php

namespace App\Http\Controllers\Enterprise;

use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Notifications\EnterpriseWidgetNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestWidgetController extends Controller
{
    public function requestWidget(Request $request): \Illuminate\Http\JsonResponse
    {
        $requestContent = $request->input('content');

        $user = User::findOrFail(Auth::id());

        if ($requestContent) {

            $feedback = new Feedback();
            $feedback->type = 'enterprise request';
            $feedback->title = 'Enterprise Widget Request';
            $feedback->user_id = $user->id;
            $feedback->user_name = $user->full_name;
            $feedback->user_email = $user->email;
            $feedback->content = $requestContent;
            $feedback->save();
            NotificationHelper::sendSalesNotifications(new EnterpriseWidgetNotification($feedback));

            $response = [
                'status' => 'success',
                'message' => 'Your request has been sent. Thank you!'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Please enter a request.'
            ];
        }

        return response()->json($response);
    }
}
