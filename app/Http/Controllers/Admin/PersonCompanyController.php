<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Person;

class PersonCompanyController extends Controller
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
        $companies = Company::orderBy('name')->get();

        // Return View to Add People and Relationships
        return view('admin.person_company', compact('person', 'companies'));
    }

    /**
     * Add a person to a company.
     */
    public function add(Request $request, $id)
    {
        $company = Company::findOrFail($request->input('company'));
        $person = Person::findOrFail($id);

        // TODO Verify if this person is already attached? Does someone can
        // have multiple position in a company?

        $person->companies()->attach($company->id, [
            'position' => $request->input('position'),
        ]);


        SendNotification::dispatch($company, 'Company has added person.', 'some long description');
        SendNotification::dispatch($person, 'Person has added to company.', 'some long description');

        return redirect()->back();
    }

}
