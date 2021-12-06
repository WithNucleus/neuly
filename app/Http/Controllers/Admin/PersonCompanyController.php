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
        $this->middleware(['permission:edit companies']);
    }

    public function index(Request $request, $id) {
        $person = Person::with('companies')->find($id);
        $companies = Company::orderBy('name')->get();

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
        $person->touch();

        $title_company = $company->name . ' added a new person';
        $title_person = $person->name . ' added to an organization';

        $description = $person->getShowLink() . ' has the position of ' . $request->input('position') . ' at ' . $company->getShowLink() . ', ' . $company->getTypeDescription() . '.';

        SendNotification::dispatch($company, $title_company, $description, 'organizations');
        SendNotification::dispatch($person, $title_person, $description, 'people');

        return redirect()->back();
    }

}
