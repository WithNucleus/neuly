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
        // Auth and Permission Middleware
        $this->middleware('auth');
        $this->middleware(['role:Admin','permission:edit companies']);
    }

    // Show View for Adding People to Companies
    public function index(Request $request, $id) {

        // Get Company
        $investor = Investor::with('people')->find($id);

        // Get All People
        $people = Person::orderBy('name')->get();

        // Return View to Add People and Relationships
        return view('admin.investor_person', compact('investor', 'people'));
    }

    /**
     * Add a person to a company.
     */
    public function add(Request $request, $id)
    {
        $investor = Investor::findOrFail($id);
        $person = Person::findOrFail($request->input('person'));

        // TODO Verify if this person is already attached? Does someone can
        // have multiple position in a company?

        $investor->people()->attach($person->id, [
            'role' => $request->input('role'),
        ]);

        $request->session()->flash('success', 'Successfully added ' . $person->name);

        SendNotification::dispatch($investor, 'investor has added a person.', 'some long description');
        SendNotification::dispatch($person, 'Person has added to a company.', 'some long description');

        return redirect()->back();
    }

    /**
     * Remove a person from a company.
     */
    public function remove(Request $request, $investor_id, $person_id)
    {
        SendNotification::dispatch(Investor::find($investor_id), 'Investor has removed person.', 'some long description');
        SendNotification::dispatch(Person::find($person_id), 'Person was removed from investor.', 'some long description');

        Investor::findOrFail($investor_id)->people()->detach($person_id);
        return redirect()->back();
    }

}
