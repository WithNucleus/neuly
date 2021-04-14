<?php

namespace App\Http\Controllers\Admin\Import;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    /**
     * Show the page for importing people records from CSV files.
     */
    public function index()
    {
        return view('admin.import.people.index');
    }

    /**
     * Processes the CSV upload for people import.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function process(Request $request)
    {
        $records = array_map('str_getcsv', file($request->file('csv')));
        $headings = array_map('strtolower', array_shift($records));
        $idIndex = array_search('id', $headings);
        $nameIndex = array_search('name', $headings);
        $results = [];

        if (!$idIndex && !$nameIndex) {
            return back()->with('error', 'Incorrect header format: at least one of the "id" and "name" columns is required!');
        }

        foreach ($records as $record) {
            $results[] = $this->processRecord($record, $headings, $idIndex, $nameIndex);
        }

        return view('admin.import.people.results', compact('results'));
    }

    /**
     * Process each CSV record.
     * @param array $record
     * @param array $headings
     * @return array
     */
    private function processRecord($record, $headings, $idIndex, $nameIndex)
    {
        $id = $record[$idIndex];
        $name = $record[$nameIndex];
        $recordMapped = array_combine($headings, array_map('trim', $record));

        if (empty($id) && empty($name)) {
            return [
                'record' => $recordMapped,
                'status' => 'Failed',
                'type' => null,
                'slug' => null,
                'name' => null,
                'error' => 'Both "id" and "name" values are empty.',
            ];
        }

        $attributes = array_filter($recordMapped, function ($value, $key) {
            return $value != '' && $key != 'id';
        }, ARRAY_FILTER_USE_BOTH);

        if ($id) {
            return $this->processRecordById($id, $attributes, $recordMapped);
        }

        return $this->processRecordByName($name, $attributes, $recordMapped);
    }

    private function processRecordById($id, $attributes, $record)
    {
        $person = Person::find($id);

        if ($person) {
            $person->update($attributes);

            return [
                'record' => $record,
                'status' => 'Success',
                'type' => 'Update',
                'slug' => $person->slug,
                'name' => $person->name,
                'error' => null,
            ];
        } else {
            return [
                'record' => $record,
                'status' => 'Failed',
                'type' => null,
                'slug' => null,
                'name' => null,
                'error' => "Entry with ID '$id' not found",
            ];
        }
    }

    private function processRecordByName($name, $attributes, $record)
    {
        $person = Person::where('name', $name)->first();

        if ($person) {
            $person->update($attributes);

            return [
                'record' => $record,
                'status' => 'Success',
                'type' => 'Update',
                'slug' => $person->slug,
                'name' => $person->name,
                'error' => null,
            ];
        }

        try {
            $attributes['slug'] = Person::generateUniqueSlug($name);

            $person = Person::create($attributes);

            return [
                'record' => $record,
                'status' => 'Success',
                'type' => 'Create',
                'slug' => $person->slug,
                'name' => $person->name,
                'error' => null,
            ];
        } catch (\Exception $exception) {
            return [
                'record' => $record,
                'status' => 'Failed',
                'type' => null,
                'slug' => null,
                'name' => null,
                'error' => $exception->getMessage(),
            ];
        }
    }
}
