<?php

namespace App\Http\Controllers\Admin\Import;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;

class ImportPeopleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:Admin','permission:import']);
    }

    public function index() {
        return view('admin.import.people.index');
    }

    public function process(Request $request) {

        $records  = array_map('str_getcsv', file($request->file('csv')));
        $headings = array_shift($records);

        $results = [];

        foreach ($records as $record) {

            $result = $this->processRecords($record, $headings);

            array_push($results, $result);

        }

        return view('admin.import.people.results', compact('results'));
    }

    private function processRecords($record, $headings) {

        $thisResult = [];
        $attributes = [];

        $name = $record[0];
        $slug = Person::generateUniqueSlug($name);

        $person = Person::where('name', $name)->first();

        foreach ($record as $key => $value) {

            $column = $headings[$key];
            $value = trim($value);

            if ($value == '') {
                continue;
            }

            $attributes[$column] = $value;
        }

        if ($person) {

            $person->update($attributes);

            $thisResult = [
                'name' => $name,
                'status' => 'Success',
                'type' => 'Update',
                'slug' => $person->slug,
            ];

        } else {

            try {

                $attributes['slug'] = Person::generateUniqueSlug($slug);

                Person::create($attributes);

                $thisResult = [
                    'name' => $name,
                    'status' => 'Success',
                    'type' => 'Create',
                    'slug' => $person->slug,
                ];

            } catch(\Exception $exception) {

                $thisResult =  [
                    'name' => $name,
                    'status' => 'failed',
                    'type' => '',
                    'slug' => '',
                ];
            }

        }

        return $thisResult;
    }
}
