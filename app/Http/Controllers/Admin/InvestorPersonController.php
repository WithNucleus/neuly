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
        $this->middleware(['permission:edit investors']);
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

        $title_investor = $investor->name . ' added a person';
        $title_person = $person->name . ' was added an investor';

        $description = $person->getShowLink() . ' has the role of ' . $request->input('role') . ' at ' . $investor->getShowLink() . ', ' . $investor->getTypeDescription() . '.';

        SendNotification::dispatch($investor, $title_investor, $description, 'investors');
        SendNotification::dispatch($person, $title_person, $description, 'people');

        return redirect()->back();
    }

    /**
     * Remove a person from a company.
     */
    public function remove(Request $request, $investor_id, $person_id)
    {
        $person = Person::findOrFail($person_id);
        $investor = Investor::findOrFail($investor_id);

        $investor->people()->detach($person_id);

        $request->session()->flash('success', 'Successfully removed ' . $person->name);

        $title_investor = $investor->name . ' removed a person';
        $title_person = $person->name . ' was removed from an investor';

        $description = $person->getShowLink() . ' is no longer with ' . $investor->getShowLink() . ', ' . $investor->getTypeDescription() . '.';

        SendNotification::dispatch($investor, $title_investor, $description, 'investors');
        SendNotification::dispatch($person, $title_person, $description, 'people');

        return redirect()->back();
    }

}
