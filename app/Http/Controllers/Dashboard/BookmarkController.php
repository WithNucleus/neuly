<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookmarkList;
use App\Models\Bookmark;
use Auth;
use Illuminate\Support\Arr;


class BookmarkController extends Controller
{

    // Add Bookmark
    public function add($entity, $entity_id, $name) {

    	// See if this Bookmark is already in one of user's lists
    	$existing_bookmarks = Bookmark::where('user_id', Auth::id())
    		->where('entity', $entity)
    		->where('entity_id', $entity_id)
    		->get();

        // Get Lists to Remove from Form
        $lists_to_remove = $existing_bookmarks->pluck('bookmark_list_id')->toArray();

    	// Get Bookmark Lists
    	$lists = BookmarkList::where('user_id', Auth::id())
            ->orderBy('name', 'asc')
            ->get();

        // Return View
        return view('members.bookmarks.add', compact('lists', 'entity', 'entity_id', 'name', 'existing_bookmarks', 'lists_to_remove'));

    }

    // Store Bookmark
    public function store(Request $request, $entity, $entity_id) {

    	$attributes = $request->validate([
    		'entity' => 'required',
    		'entity_id' => 'required|integer',
    		'bookmark_list_id' => 'required|integer',
    		'name' => 'min:3|max:150',
    		// 'name' => 'required|min:3|max:255|unique:bookmark_lists,name,NULL,id,user_id,'.Auth::user()->id,
	        'notes' => 'nullable|max:255'
	    ]);

	    // Check List
	    $list = BookmarkList::findOrFail($attributes['bookmark_list_id']);

	    // Add User ID
	    $attributes['user_id'] = Auth::id();

	    // Create Bookmark
	    $bookmark = Bookmark::create($attributes);

	    // Redirect to Entity with Message
	    session()->flash('success', $bookmark->name . ' saved to ' . $list->name . '!');
	    return redirect(url()->previous());

    }

    // View All Bookmarks
    public function index() {

        // Get Bookmarks
        $bookmarks = Bookmark::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Return View
        return view('members.bookmarks.all-bookmarks', compact('bookmarks'));

    }

    public function edit(Request $request, $id) {

        // Send Previous URL to Update
        $previous_url = url()->previous();

        // Find
        $bookmark = Bookmark::findOrFail($id);

        // Abort if Doesn't Belong to User
        if ($bookmark->user_id !== Auth::id()) {
            abort('404');
        }

        // Get User's Lists
        $lists = BookmarkList::where('user_id', Auth::id())
                ->orderBy('name', 'asc')
                ->get();

        // See if this Bookmark is already in one of user's lists
        $existing_bookmarks = Bookmark::where('user_id', Auth::id())
            ->where('entity', $bookmark->entity)
            ->where('entity_id', $bookmark->entity_id)
            ->get();

        // Get Lists to Remove from Form
        $lists_to_remove = $existing_bookmarks->pluck('bookmark_list_id')->toArray();

        return view('members.bookmarks.edit-bookmark', compact('bookmark', 'lists', 'lists_to_remove', 'previous_url'));
    }

    public function update(Request $request, $id) {

        // Find
        $bookmark = Bookmark::findOrFail($id);

        // Abort if Doesn't Belong to User
        if ($bookmark->user_id !== Auth::id()) {
            abort('404');
        }

        // Get Attributes
        $attributes = $request->validate([
            'name' => 'required|min:1|max:150',
            'notes' => 'nullable|max:255',
            'bookmark_list_id' => 'integer|nullable'
        ]);

        // Previous URL?
        if ($request->input('previous_url') == '') {
            $previous_url = '/dashboard';
        } else {
            $previous_url = $request->input('previous_url');
        }

        // If Change List
        if ($request->input('bookmark_list_id') != $bookmark->bookmark_list_id) {
            $bookmark->bookmark_list_id = $request->input('bookmark_list_id');
        }

        $bookmark->name = $request->input('name');
        $bookmark->notes = $request->input('notes');
        $bookmark->save();

        return redirect($previous_url)->with('success', $request->input('name') . ' was updated.');
    }

    public function destroy(Request $request, $id) {

        // Find
        $bookmark = Bookmark::findOrFail($id);

        // Abort if Doesn't Belong to User
        if ($bookmark->user_id !== Auth::id()) {
            abort('404');
        }

        $bookmark_title = $bookmark->name;

        $bookmark->delete();

        return redirect(url()->previous())->with('success', $bookmark_title . ' was deleted from your bookmarks.');

    }
}
