<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotificationsByAuthedUser(Request $request)
    {
        $notifications = Notification::ofUser(Auth::id())->paginate(10);

        return response($notifications, Response::HTTP_OK);
    }

    public function getUnreadNotificationsCountByAuthedUser(Request $request)
    {
        $unread = Notification::ofUser(Auth::id())->unseen()->get();

        return response($unread->count(), Response::HTTP_OK);
    }

    public function index(Request $request)
    {
        $notifications = Notification::ofUser(Auth::id())->orderBy('created_at', 'desc')->paginate(50);
        $unread = Notification::ofUser(Auth::id())->unseen()->get();

        return view('discover.notifications.index', compact('notifications', 'unread'));
    }

    public function show(Request $request, Notification $notification)
    {
        if ($notification->was_read === 0) {
            $notification->was_read = 1;
            $notification->save();
        }

        return view('discover.notifications.show', compact('notification'));
    }

    public function delete(Request $request, Notification $notification)
    {
        $notification->delete();
    }

    public function setRead(Request $request, Notification $notification)
    {
        $notification->was_read = 1;
        $notification->save();

        return response('', Response::HTTP_OK);
    }

    public function setReadAll(Request $request)
    {
        $unread = Notification::ofUser(Auth::id())->unseen()->get();
        foreach ($unread as $notification) {
            $notification->was_read = 1;
            $notification->save();
        }

        return response('', Response::HTTP_OK);
    }
}
