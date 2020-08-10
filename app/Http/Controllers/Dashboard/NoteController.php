<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MemberNote;
use Auth;
use Validator;
use DB;
use App\User;
use App\Repositories\BookmarkRepository;

class NoteController extends Controller
{

	// Index
	public function index() {

		$notes = MemberNote::where('user_id', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->get();

		return view('members.notes.index', compact('notes'));

	}

	// Note Editor
    public function create() {

    	// Return View
    	return view('members.notes.create');

    }

    // Check Slug via ajax
    public function checkSlug(Request $request) {

        // New Note?
        if ($request->input('note_id') == 'new') {

            $validator = Validator::make($request->all(), [
                'slug' => 'required|max:80|unique:member_notes,slug,NULL,id,user_id,' . Auth::user()->id,
            ]);

        } else {

            $note = MemberNote::findOrFail($request->input('note_id'));

            // Updated Note -- Check if this Matches Current URL
            if ($request->input('slug') != $note->slug) {

                $validator = Validator::make($request->all(), [
                    'slug' => 'required|max:80|unique:member_notes,slug,NULL,id,user_id,' . Auth::user()->id,
                ]);

            } else {
                
                return response()->json(['success' => 'Looks good!']);

            }
        }

        if ($validator->passes()) {

	    	return response()->json(['success' => 'Looks good!']);
	    }

	    return response()->json(['error'=>$validator->errors()->all()]);

    }

    // Store Note
    public function store(Request $request) {

    	$validator = $request->validate([
    		'title' => 'nullable|max:255',
    		'slug' => 'required|max:255|unique:member_notes,slug,NULL,id,user_id,' . Auth::user()->id,
	        'description' => 'nullable|max:255',
	        'visibility' => 'required'
	    ]);	  

	    // If Title is Blank
	    if ($request->input('title') == '') {
	    	$title = 'Untitled';
	    } else {
	    	$title = $request->input('title');
	    }

	    // Create Note
    	$note = MemberNote::create([
		    'membernote-trixFields' => $request->input('membernote-trixFields'),
		    'title' => $title,
		    'slug' => $request->input('slug'),
		    'user_id' => Auth::id(),
		    'visibility' => $request->input('visibility')
		]);

		// Redirect to Notes with Message
	    session()->flash('success', $note->title . ' saved!');
	    return redirect(route('member.notes.index'));

    }

    // Show Note -- User View
    public function show($slug) {

        $note = MemberNote::where('user_id', Auth::id())
            ->where('slug', $slug)
            ->first();

        $member = User::findOrFail(Auth::id());

        if ($note) {

            $entity = 'member-notes';
            $bookmarks = BookmarkRepository::fromUser($entity, $note->id);

            return view('members.notes.show', compact('note', 'entity', 'bookmarks', 'member'));
        } else {
            abort('404');
        }

    }

    // Show Note -- Public
    public function showPublic($member_url, $slug) {

        $member = User::where('member_url', $member_url)->first();

        if (!$member) {
            abort(404);
        }

        $note = MemberNote::where('user_id', $member->id)
                ->where('slug', $slug)
                ->where('visibility', 'public')
                ->first();

        if (!$note) {
            abort(404);
        }

        return view('members.notes.public', compact('note', 'member'));

    }

    // Edit Note
    public function edit($slug) {

        $note = MemberNote::where('user_id', Auth::id())
            ->where('slug', $slug)
            ->first();

        if (!$note) {
            abort('404');
        }

    	return view('members.notes.edit', compact('note'));

    }

    // Update Note
    public function update($id, Request $request) {

        // Find Note
        $note = MemberNote::findOrFail($id);

        // Abort if Can't Find Note
        if (!$note) {
            abort('404');
        }

        // Abort if Note Doesn't Belong to User
        if ($note->user_id !== Auth::id()) {
            abort('404');
        }

        // If Title is Blank
        if ($request->input('title') == '') {
            $title = 'Untitled';
        } else {
            $title = $request->input('title');
        }

        // Update Title
        $note->title = $title;

        // Update Visibility
        $note->visibility = $request->input('visibility');

        // Update Slug
        $note->slug = $request->input('slug');

        // Save Note
        $note->save();

        // Find and Update Trix Record
        $trix_content = DB::table('trix_rich_texts')
            ->where('model_type', 'App\Models\MemberNote')
            ->where('model_id', $note->id)
            ->update([
                'content' => $request->input('membernote-trixFields.content')
            ]);

        // Return to Note
        return redirect(route('member.notes.show', $note->slug));

    }

    public function destroy($id) {

        // Find Note
        $note = MemberNote::findOrFail($id);

        // Abort if Can't Find Note
        if (!$note) {
            abort('404');
        }

        // Abort if Note Doesn't Belong to User
        if ($note->user_id !== Auth::id()) {
            abort('404');
        }

        $note_title = $note->title;

        $note->delete();

        return redirect(route('member.notes.index'))->with('success', $note_title . ' was deleted.');

    }

}
