<?php

namespace App\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPersonController extends Controller
{
    public function index()
    {
        $person = Auth::user()->relatedPerson;

        return view('members.person.index', compact('person'));
    }

    public function email()
    {
        $person = Auth::user()->relatedPerson;

        if(!$person)
        {
            abort(404);
        }

        return view('members.person.email', compact('person'));
    }

    public function social()
    {
        $person = Auth::user()->relatedPerson;

        if(!$person)
        {
            abort(404);
        }

        return view('members.person.social', compact('person'));
    }

    public function savePersonal(Request $request)
    {
        $person = Auth::user()->relatedPerson;
        $person->visibility = $request->has('visibility') ? $request->input('visibility') : $person->visibility;
        $person->name = $request->has('name') ? $request->input('name') : $person->name;
        $person->bio = $request->has('name') ? $request->input('bio') : $person->bio;

        $person->save();

        $request->session()->flash('success', 'Your data was saved successfully.');

        return redirect()->route('user.person.index');
    }

    public function saveEmail(Request $request)
    {
        $person = Auth::user()->relatedPerson;
        $person->email = $request->has('email') ? $request->input('email') : $person->email;
        $person->secondary_email = $request->has('secondary_email') ? $request->input('secondary_email') : $person->secondary_email;

        $person->save();

        $request->session()->flash('success', 'Your data was saved successfully.');

        return redirect()->route('user.person.email');
    }

    public function saveSocial(Request $request)
    {
        $person = Auth::user()->relatedPerson;
        $person->website = $request->has('website') ? $request->input('website') : $person->website;
        $person->facebook = $request->has('facebook') ? $request->input('facebook') : $person->facebook;
        $person->linkedin = $request->has('linkedin') ? $request->input('linkedin') : $person->linkedin;
        $person->google_scholar = $request->has('google_scholar') ? $request->input('google_scholar') : $person->google_scholar;
        $person->save();

        $request->session()->flash('success', 'Your data was saved successfully.');

        return redirect()->route('user.person.social');
    }

    public function create()
    {
        return view('members.person.create');
    }

    public function createEmail(Request $request)
    {
        $user = Auth::user();
        $person = new Person();
        $person->visibility = $request->has('visibility') ? $request->input('visibility') : $person->visibility;
        $person->name = $request->has('name') ? $request->input('name') : $person->name;
        $person->slug = Person::generateUniqueSlug($person->name);
        $person->bio = $request->has('name') ? $request->input('bio') : $person->bio;
        $person->user_id = $user->id;
        $person->save();

        $user->person_id = $person->id;
        $user->save();


        return view('members.person.create_email');
    }

    public function createSocial(Request $request)
    {
        $person = Auth::user()->relatedPerson;
        $person->email = $request->has('email') ? $request->input('email') : $person->email;
        $person->secondary_email = $request->has('secondary_email') ? $request->input('secondary_email') : $person->secondary_email;

        $person->save();

        return view('members.person.create_social');
    }

    public function createFinish(Request $request)
    {
        $person = Auth::user()->relatedPerson;
        $person->website = $request->has('website') ? $request->input('website') : $person->website;
        $person->facebook = $request->has('facebook') ? $request->input('facebook') : $person->facebook;
        $person->linkedin = $request->has('linkedin') ? $request->input('linkedin') : $person->linkedin;
        $person->google_scholar = $request->has('google_scholar') ? $request->input('google_scholar') : $person->google_scholar;
        $person->save();

        return view('members.person.finish');
    }

    public function search(Request $request)
    {
        $user = Auth::user();

        $cleanTerm = $user->name . ' ' . $user->lastname;

        $searchTerm = '%'.$user->name.'%'.$user->lastname.'%';

        if($request->has('search'))
        {
            $searchTerm = '%'.$request->input('search').'%';
            $cleanTerm = $request->input('search');
        }

        $people = Person::where('name', 'like', $searchTerm)->get();

        return view('members.person.search', compact('people', 'cleanTerm'));
    }
}
