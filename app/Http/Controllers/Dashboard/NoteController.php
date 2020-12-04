<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MemberNote;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{

	public function index() {
		$notes = MemberNote::where('user_id', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->get();

		return view('members.notes.index', compact('notes'));
	}

    public function create() {
    	return view('members.notes.create');
    }

    // Check Slug via ajax
    public function checkSlug(Request $request) {

        // New Note?
        if ($request->input('note_id') == 'new') {

            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
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
    	$request->validate([
    		'title' => 'required|max:255',
    		'slug' => 'required|max:80|unique:member_notes,slug,NULL,id,user_id,' . Auth::user()->id,
	        'description' => 'nullable|max:255',
	        'visibility' => 'required'
	    ]);

    	$note = MemberNote::create([
		    'title' => $request->input('title'),
		    'slug' => $request->input('slug'),
		    'user_id' => Auth::id(),
		    'visibility' => $request->input('visibility'),
		]);

    	$note->saveTrixRichText($request->input('membernote-trixFields'));

	    session()->flash('success', $note->title . ' saved!');
	    return redirect(route('member.notes.index'));
    }

    public function show($slug) {
        $note = MemberNote::where('user_id', Auth::id())
            ->where('slug', $slug)
            ->firstOrFail();

        $member = Auth::user();
        $entity = 'member-notes';

        return view('members.notes.show', compact('note', 'entity', 'member'));
    }

    public function showPublic($member_url, $slug) {

        $member = User::where('member_url', $member_url)->firstOrFail();

        $note = MemberNote::where('user_id', $member->id)
                ->where('slug', $slug)
                ->where('visibility', 'public')
                ->firstOrFail();

        return view('members.notes.public', compact('note', 'member'));
    }

    public function edit($slug) {
        $note = MemberNote::where('user_id', Auth::id())
            ->where('slug', $slug)
            ->firstOrFail();

    	return view('members.notes.edit', compact('note'));
    }

    public function update($id, Request $request) {

        $note = MemberNote::where('user_id', Auth::id())->findOrFail($id);

        $note->title = $request->input('title', 'Untitled');
        $note->visibility = $request->input('visibility');
        $note->slug = $request->input('slug');
        $note->save();

        $note->saveTrixRichText($request->input('membernote-trixFields'));

        return redirect(route('member.notes.show', $note->slug));
    }

    public function destroy($id) {
        $note = MemberNote::where('user_id', Auth::id())->findOrFail($id);
        $note_title = $note->title;
        $note->delete();

        return redirect(route('member.notes.index'))->with('success', $note_title . ' was deleted.');
    }

}
