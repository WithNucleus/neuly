<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendNotification;
use App\Http\Controllers\Controller;
use App\Models\Investor;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Person;

class PersonInvestorController extends Controller
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
        $person = Person::with('companies')->find($id);

        // Get All People
        $investors = Investor::orderBy('name')->get();

        // Return View to Add People and Relationships
        return view('admin.person_investor', compact('person', 'investors'));
    }

    /**
     * Add a person to a company.
     */
    public function add(Request $request, $id)
    {
        $investor = Investor::findOrFail($request->input('investor'));
        $person = Person::findOrFail($id);

        // TODO Verify if this person is already attached? Does someone can
        // have multiple position in a company?

        $person->investors()->attach($investor->id, [
            'role' => $request->input('role'),
        ]);

        $title_investor = $investor->name . ' added a person';
        $title_person = $person->name . ' was added an investor';

        $description = $person->getShowLink() . ' has the role of ' . $request->input('role') . ' at ' . $investor->getShowLink() . ', ' . $investor->getTypeDescription() . '.';
        
        SendNotification::dispatch($investor, $title_investor, $description, 'investors');
        SendNotification::dispatch($person, $title_person, $description, 'people');

        return redirect()->back();
    }

}
