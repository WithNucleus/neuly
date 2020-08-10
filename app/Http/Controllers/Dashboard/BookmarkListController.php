<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookmarkList;
use App\Models\Bookmark;
use Auth;
use Validator;

class BookmarkListController extends Controller
{

    // Bookmark Lists with Create Form
    public function index() {

    	// Get Lists
    	$lists = BookmarkList::where('user_id', Auth::id())->orderBy('name', 'asc')->get();

        // Get Latest Bookmarks
        $bookmarks = Bookmark::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get();

    	// Return View
    	return view('members.bookmarks.index', compact('lists', 'bookmarks'));

    }

    // Save Bookmark List
    public function store(Request $request) {

    	// Get Attributes
    	$attributes = $request->validate([
    		'name' => 'required|min:3|max:255|unique:bookmark_lists,name,NULL,id,user_id,'.Auth::user()->id,
	        'description' => 'max:255'
	    ]);

	    // Set User ID
	    $attributes['user_id'] = Auth::id();

	    // Create List
	    $bookmark_list = BookmarkList::create($attributes);

	    // Redirect to Lists View with Message
	    session()->flash('success', $attributes['name'] . ' was created!');
	    // return redirect()->route('member.bookmarks.index');
        return back();

    }

    // Bookmark List Create Form -- For Modals
    public function create() {
        return view('members.bookmarks.create-form');
    }

    // Bookmark List Create Form -- For Modals
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

    // Bookmark List Show
    public function show($slug) {

        // Get List
        $list = BookmarkList::Where('slug', $slug)
                ->where('user_id', Auth::id())
                ->first();

        if (!$list) {
            abort('404');
        }

        // Get Bookmarks
        $bookmarks = Bookmark::where('bookmark_list_id', $list->id)->get();

        // Return View
        return view('members.bookmarks.show-list', compact('list', 'bookmarks'));

    }

    // Edit Bookmark List
    public function edit($slug) {

        $list = BookmarkList::Where('slug', $slug)
                ->where('user_id', Auth::id())
                ->first();

        if (!$list) {
            abort('404');
        }

        return view('members.bookmarks.edit-list', compact('list'));

    }

    // Update Bookmark List
    public function update($id, Request $request) {

        // Find List
        $list = BookmarkList::findOrFail($id);

        // Abort if Can't Find List
        if (!$list) {
            abort('404');
        }

        // Abort if List Doesn't Belong to User
        if ($list->user_id !== Auth::id()) {
            abort('404');
        }

        // Check if Name Changed
        if ($request->input('name') != $list->name) {

            $attributes = $request->validate([
                'name' => 'required|min:3|max:255|unique:bookmark_lists,name,NULL,id,user_id,'.Auth::user()->id,
                'description' => 'nullable|max:255'
            ]);

            $list->name = $request->input('name');
            $list->description = $request->input('description');
            $list->save();

        } else {

            $attributes = $request->validate([
                'description' => 'nullable|max:255'
            ]);

            $list->description = $request->input('description');
            $list->save();
        }

        // Go back
        return redirect()->route('member.bookmarks.index')->with('success', $list->name . ' was updated');
        
    }

    public function destroy($id) {

        // Find Note
        $list = BookmarkList::findOrFail($id);

        // Abort if Can't Find Note
        if (!$list) {
            abort('404');
        }

        // Abort if List Doesn't Belong to User
        if ($list->user_id !== Auth::id()) {
            abort('404');
        }

        // Delete all Bookmarks in this List
        $bookmarks = Bookmark::where('bookmark_list_id', $list->id)->delete();

        $list_title = $list->name;

        $list->delete();

        return redirect(route('member.bookmarks.index'))->with('success', $list_title . ' was deleted.');

    }
}
