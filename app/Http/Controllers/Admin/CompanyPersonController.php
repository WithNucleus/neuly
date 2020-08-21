<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Person;
use App\Events\SendNotification;

class CompanyPersonController extends Controller
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
    	$company = Company::with('people')->find($id);

    	// Get All People
    	$people = Person::orderBy('name')->get();

    	// Return View to Add People and Relationships
    	return view('admin.company_person', compact('company', 'people'));
    }

    /**
     * Add a person to a company.
     */
    public function add(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $person = Person::findOrFail($request->input('person'));

        // TODO Verify if this person is already attached? Does someone can
        // have multiple position in a company?

        SendNotification::dispatch($company, 'Company has added person.', 'some long description');
        SendNotification::dispatch($person, 'Person has added to company.', 'some long description');

        $company->people()->attach($person->id, [
            'position' => $request->input('position'),
        ]);
        return redirect()->back();
    }

    /**
     * Remove a person from a company.
     */
    public function remove(Request $request, $company_id, $person_id)
    {
        SendNotification::dispatch(Company::find($company_id), 'Company has removed person.', 'some long description');
        SendNotification::dispatch(Person::find($person_id), 'Person was removed from company.', 'some long description');

        Company::findOrFail($company_id)->people()->detach($person_id);
        return redirect()->back();
    }
}
