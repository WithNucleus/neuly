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
        $this->middleware(['permission:edit companies']);
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
        $title_company = $company->name . ' added a new person';
        $title_person = $person->name . ' added to an organization';

        $description = $person->getShowLink() . ' has the position of ' . $request->input('position') . ' at ' . $company->getShowLink() . ', ' . $company->getTypeDescription() . '.';

        SendNotification::dispatch($company, $title_company, $description, 'organizations');
        SendNotification::dispatch($person, $title_person, $description, 'people');

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
        $company = Company::findOrFail($company_id);
        $person = Person::findOrFail($person_id);

        $title = $person->name . ' left ' . $company->name;

        $description = $person->getShowLink() . ' no longer works at ' . $company->getShowLink() . ', ' . $company->getTypeDescription() . '.';

        SendNotification::dispatch($company, $title, $description, 'organizations');
        SendNotification::dispatch($person, $title, $description, 'people');

        Company::findOrFail($company_id)->people()->detach($person_id);
        return redirect()->back();
    }
}
