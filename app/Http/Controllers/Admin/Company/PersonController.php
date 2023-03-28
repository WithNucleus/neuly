<?php

namespace App\Http\Controllers\Admin\Company;

use App\Events\SendNotification;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $company = Company::with('people')->find($id);
        $people = Person::orderBy('name')->get();

        return view('admin.company.person', compact('company', 'people'));
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $person = Person::findOrFail($request->input('person'));

        // TODO Verify if this person is already attached? Does someone can
        // have multiple position in a company?
        $title_company = $company->name.' added a new person';
        $title_person = $person->name.' added to an organization';

        $description = $person->getShowLink().' has the position of '.$request->input('position').' at '.$company->getShowLink().', '.$company->getTypeDescription().'.';

        SendNotification::dispatch($company, $title_company, $description, 'organizations');
        SendNotification::dispatch($person, $title_person, $description, 'people');

        $company->people()->attach($person->id, [
            'position' => $request->input('position'),
        ]);
        $company->touch();

        return redirect()->back();
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $company_id
     * @param  int  $person_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($company_id, $person_id)
    {
        $company = Company::findOrFail($company_id);
        $person = Person::findOrFail($person_id);

        $title = $person->name.' left '.$company->name;
        $description = $person->getShowLink().' no longer works at '.$company->getShowLink().', '.$company->getTypeDescription().'.';

        SendNotification::dispatch($company, $title, $description, 'organizations');
        SendNotification::dispatch($person, $title, $description, 'people');

        $company->people()->detach($person_id);
        $company->touch();

        return redirect()->back();
    }
}
