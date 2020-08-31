<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Helpers\EntityHelper;
use Illuminate\Http\Request;
use Auth;

class FollowController extends Controller
{
    public function index()
    {
        $follows = Follow::with('followable')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('members.follow.index', compact('follows'));
    }

    public function show($id)
    {
        $follow    = Follow::with('followable')
            ->where('user_id', Auth::id())
            ->findOrFail($id);
        $routeName = EntityHelper::getAliasByClass($follow->followable_type);

        if ($routeName === false) {
            abort(404);
        }

        return redirect()->route('discover.' . $routeName . '.show', $follow->followable->slug);
    }

    public function edit($id)
    {
        $follow      = Follow::with('followable')
            ->where('user_id', Auth::id())
            ->findOrFail($id);
        $previousUrl = url()->previous();

        return view('members.follow.edit', compact('follow', 'previousUrl'));
    }

    /**
     * @param \App\Http\Requests\FollowRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $appNotification   = $request->input('app_notification', 0);
        $emailNotification = $request->input('email_notification', 0);
        $redirectUrl       = $request->input('previous_url', url()->previous());

        if ($emailNotification == 0 && $appNotification == 0) {
            return redirect()->back()
                ->withInput(['previous_url' => $redirectUrl])
                ->with('error', 'You have to choose at least one alert option to follow this...');
        }

        $follow = Follow::with('followable')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $follow->app_notification   = $appNotification;
        $follow->email_notification = $emailNotification;
        $follow->save();

        return redirect($redirectUrl)
            ->with('success', '"' . $follow->followable->name . '" subscription was updated.');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function attach(Request $request)
    {
        $entity            = null;
        $user              = auth()->user();
        $followableId      = $request->input('followable_id');
        $followableType    = $request->input('followable_type');
        $emailNotification = $request->input('email_notification', 0);
        $appNotification   = $request->input('app_notification', 0);

        if ($emailNotification == 0 && $appNotification == 0) {
            return redirect()->back()->with('error', 'You have to choose at least one alert option to follow this...');
        }

        if (in_array($followableType, EntityHelper::getEntities()) === true) {
            $entity = $followableType::find($followableId);
        }

        if ($entity === null) {
            return redirect()->back()->with('error', 'There was a problem with following, please try again later.');
        }

        $entity->followers()->attach($user, [
            'email_notification' => $emailNotification,
            'app_notification' => $appNotification,
        ]);

        return redirect()->back()->with('success', 'Congrats - you\'re now following ' . $entity->name . '!');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function detach(Request $request)
    {
        $entity         = null;
        $user           = auth()->user();
        $followableId   = $request->input('followable_id');
        $followableType = $request->input('followable_type');
        $redirectUrl    = $request->input('previous_url', url()->previous());

        if (in_array($followableType, EntityHelper::getEntities()) === true) {
            $entity = $followableType::find($followableId);
        }

        if ($entity === null) {
            return redirect()->back()->with('error', 'There was a problem with unfollowing, please try again later.');
        }

        $entity->followers()->detach($user);

        return redirect($redirectUrl)->with('success', 'Congrats - you unfollowed ' . $entity->name . '!');
    }
}
