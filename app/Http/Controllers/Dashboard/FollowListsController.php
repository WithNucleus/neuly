<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\FollowListRequest;
use App\Models\Follow;
use App\Models\FollowList;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FollowListsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $lists = FollowList::with('followItems')
            ->where('user_id', Auth::id())
            ->orderBy('name', 'asc')
            ->get();

        $follows = Follow::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('members.follow-lists.index', compact('lists', 'follows'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FollowListRequest $request)
    {
        $list = new FollowList();
        $list->user_id = Auth::id();
        $list->name = $request->input('name');
        $list->description = $request->input('description');
        $list->is_public = $request->input('is_public', 0);
        $list->save();

        session()->flash('success', $list->name.' was created!');

        return redirect()->back();
    }

    /**
     * @param  string  $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $list = FollowList::with('followItems', 'user')
            ->where('slug', $slug)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('members.follow-lists.show', compact('list'));
    }

    /**
     * @param  string  $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($slug)
    {
        $list = FollowList::where('slug', $slug)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('members.follow-lists.edit', compact('list'));
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FollowListRequest $request, $id)
    {
        $list = FollowList::where('user_id', Auth::id())
            ->findOrFail($id);

        $list->name = $request->input('name');
        $list->slug = $request->input('slug');
        $list->description = $request->input('description');
        $list->is_public = $request->input('is_public', 0);
        $list->save();

        return redirect()
            ->route('member.follow-lists.index')
            ->with('success', $list->name.' was updated');
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $list = FollowList::where('user_id', Auth::id())
            ->findOrFail($id);
        $listName = $list->name;

        $list->delete();

        return redirect()
            ->route('member.follow-lists.index')
            ->with('success', $listName.' was deleted.');
    }

    /**
     * @param  string  $member_url
     * @param  string  $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPublic($member_url, $slug)
    {
        $user = User::where('member_url', $member_url)->firstOrFail();
        $list = FollowList::with('followItems')
            ->where('slug', $slug)
            ->where('user_id', $user->id)
            ->where('is_public', true)
            ->firstOrFail();

        return view('members.follow-lists.public', compact('user', 'list'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255|unique:follow_lists,name,NULL,id,user_id,'.auth()->user()->id,
        ]);

        if ($validator->passes()) {
            return response()->json(['status' => 'ok']);
        }

        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors()->all(),
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxStore(FollowListRequest $request)
    {
        $list = new FollowList();
        $list->user_id = Auth::id();
        $list->name = $request->input('name');
        $list->description = $request->input('description');
        $list->is_public = $request->input('is_public', 0);
        $list->save();

        return response()->json([
            'status' => 'ok',
            'data' => [
                'id' => $list->id,
                'name' => $list->name,
            ],
        ]);
    }
}
