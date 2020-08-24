<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookmarkListRequest;
use App\Models\Bookmark;
use App\Models\BookmarkList;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Validator;

class BookmarkListController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
    	$lists = BookmarkList::with('bookmarks')
            ->where('user_id', Auth::id())
            ->orderBy('name', 'asc')
            ->get();

        $bookmarks = Bookmark::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get();

    	return view('members.bookmarks.index', compact('lists', 'bookmarks'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        return view('members.bookmarks.create-form');
    }

    /**
     * @param \App\Http\Requests\BookmarkListRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BookmarkListRequest $request)
    {
        $list              = new BookmarkList();
        $list->user_id     = Auth::id();
        $list->name        = $request->input('name');
        $list->description = $request->input('description');
        $list->is_public   = $request->input('is_public', 0);
        $list->save();

        session()->flash('success', $list->name . ' was created!');

        return redirect()->back();
    }

    /**
     * Save action for ajax request from modal form
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function quickSave(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255|unique:bookmark_lists,name,NULL,id,user_id,'.Auth::user()->id,
            'description' => 'nullable|max:255'
        ]);

        if ($validator->passes()) {
            return response()->json(['success' => 'Success!']);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug) {
        $member    = User::findOrFail(Auth::id());
        $list      = BookmarkList::Where('slug', $slug)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        $bookmarks = Bookmark::where('bookmark_list_id', $list->id)->get();

        return view('members.bookmarks.show-list', compact('list', 'bookmarks', 'member'));
    }

    /**
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($slug) {
        $list = BookmarkList::Where('slug', $slug)
                ->where('user_id', Auth::id())
                ->firstOrFail();

        return view('members.bookmarks.edit-list', compact('list'));
    }

    /**
     * @param \App\Http\Requests\BookmarkListRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BookmarkListRequest $request, $id) {
        $list = BookmarkList::where('user_id', Auth::id())
            ->findOrFail($id);

        $list->name        = $request->input('name');
        $list->slug        = $request->input('slug');
        $list->description = $request->input('description');
        $list->is_public   = $request->input('is_public', 0);
        $list->save();

        return redirect()
            ->route('member.bookmarks.index')
            ->with('success', $list->name . ' was updated');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) {
        $list      = BookmarkList::where('user_id', Auth::id())
            ->findOrFail($id);
        $listName = $list->name;

        Bookmark::where('bookmark_list_id', $list->id)->delete();
        $list->delete();

        return redirect()
            ->route('member.bookmarks.index')
            ->with('success', $listName . ' was deleted.');
    }

    /**
     * @param string $member_url
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPublic($member_url, $slug) {
        $member    = User::where('member_url', $member_url)->firstOrFail();
        $list      = BookmarkList::where('slug', $slug)
            ->where('user_id', $member->id)
            ->where('is_public', true)
            ->firstOrFail();
        $bookmarks = Bookmark::where('bookmark_list_id', $list->id)->get();

        return view('members.bookmarks.public-list', compact('member', 'list', 'bookmarks'));
    }
}
