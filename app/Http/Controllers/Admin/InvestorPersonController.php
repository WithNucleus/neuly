<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendNotification;
use App\Http\Controllers\Controller;
use App\Models\Investor;
use Illuminate\Http\Request;
use App\Models\Person;

class InvestorPersonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:Admin','permission:edit companies']);
    }

    // Show View for Adding People to Companies
    public function index(Request $request, $id) {

        $investor = Investor::with('people')->find($id);

        $people = Person::orderBy('name')->pluck('name')->toJson();

        return view('admin.investor_person', compact('investor', 'people'));
    }

    /**
     * Add a person to a company.
     */
    public function add(Request $request, $id)
    {
        $investor = Investor::findOrFail($id);

        $person = Person::where('name', $request->input('person'))->first();

        if (!$person) {
            $request->session()->flash('error', 'Uh oh - could not find the person. Try again.');
            return redirect()->back();
        }

        $investor->people()->attach($person->id, [
            'role' => $request->input('role'),
        ]);

        $request->session()->flash('success', 'Successfully added ' . $person->name);

        SendNotification::dispatch($investor, 'Investor has added a person.', 'some long description');
        SendNotification::dispatch($person, 'Person was added to an investor.', 'some long description');

        return redirect()->back();
    }

    /**
     * Remove a person from a company.
     */
    public function remove(Request $request, $investor_id, $person_id)
    {
        $person = Person::findOrFail($person_id);

        Investor::findOrFail($investor_id)->people()->detach($person_id);

        $request->session()->flash('success', 'Successfully removed ' . $person->name);

        SendNotification::dispatch(Investor::find($investor_id), 'Investor has removed a person.', 'some long description');
        SendNotification::dispatch(Person::find($person_id), 'Person was removed from an investor.', 'some long description');

        return redirect()->back();
    }

}
