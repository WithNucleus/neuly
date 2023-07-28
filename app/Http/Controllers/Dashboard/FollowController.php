<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\EntityHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FollowRequest;
use App\Models\Follow;
use App\Models\FollowList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $follow = Follow::with('followable')
            ->where('user_id', Auth::id())
            ->findOrFail($id);
        $routeName = EntityHelper::getAliasByClass($follow->followable_type);

        if ($routeName === false) {
            abort(404);
        }

        return redirect()->route('discover.'.$routeName.'.show', $follow->followable->slug);
    }

    public function edit($id)
    {
        $entity = Follow::with('followable')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('members.follow.edit', [
            'entity' => $entity
        ]);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FollowRequest $request, $id)
    {
        $followListId = $request->input('follow_list_id');
        $appNotification = $request->input('app_notification', 0);
        $emailNotification = $request->input('email_notification', 0);
        $redirectUrl = $request->input('previous_url', url()->previous());
        $notes = $request->input('notes');

        $follow = Follow::with('followable')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $follow->follow_list_id = $followListId;
        $follow->app_notification = $appNotification;
        $follow->email_notification = $emailNotification;
        $follow->notes = $notes;
        $follow->save();

        return redirect($redirectUrl)
            ->with('success', '"'.$follow->followable->name.'" subscription was updated.');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getModal($followableId, $followableType)
    {
        $entity = null;

        if (in_array($followableType, EntityHelper::getEntities()) === true) {
            $entity = $followableType::find($followableId);
        }

        $lists = FollowList::where('user_id', Auth::id())
            ->orderBy('name', 'asc')
            ->get();

        return view('members.follow.modals.follow', compact('entity', 'lists'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attach(FollowRequest $request)
    {
        $entity = null;
        $user = auth()->user();
        $followableId = $request->input('followable_id');
        $followableType = $request->input('followable_type');
        $followListId = $request->input('follow_list_id');
        $emailNotification = $request->input('email_notification', 0);
        $appNotification = $request->input('app_notification', 0);
        $notes = $request->input('notes');

        if (in_array($followableType, EntityHelper::getEntities()) === true) {
            $entity = $followableType::find($followableId);
        }

        if ($entity === null) {
            return redirect()->back()->with('error', 'There was a problem with following, please try again later.');
        }

        $entity->followers()->attach($user, [
            'follow_list_id' => $followListId,
            'email_notification' => $emailNotification,
            'app_notification' => $appNotification,
            'notes' => $notes,
        ]);

        return redirect()->back()->with('success', 'Congrats - you\'re now following '.$entity->name.'!');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function detach(Request $request)
    {
        $entity = null;
        $user = auth()->user();
        $followableId = $request->input('followable_id');
        $followableType = $request->input('followable_type');
        $redirectUrl = $request->input('previous_url', url()->previous());

        if (in_array($followableType, EntityHelper::getEntities()) === true) {
            $entity = $followableType::find($followableId);
        }

        if ($entity === null) {
            return redirect()->back()->with('error', 'There was a problem with unfollowing, please try again later.');
        }

        $entity->followers()->detach($user);

        return redirect($redirectUrl)->with('success', 'Congrats - you unfollowed '.$entity->name.'!');
    }
}
