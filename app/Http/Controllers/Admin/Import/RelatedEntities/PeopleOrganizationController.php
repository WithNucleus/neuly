<?php

namespace App\Http\Controllers\Admin\Import\RelatedEntities;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Import\RelatedEntities\PeopleOrganisationRequest;
use App\Jobs\Import\RelatedEntities\ProcessPeopleOrganization;
use App\Models\ImportResult;
use Illuminate\Support\Facades\Auth;

class PeopleOrganizationController extends Controller
{
    private $allowedColumns = [
        'organization name',
        'organization id',
        'person name',
        'position',
        'email',
        'location',
        'linkedin',
    ];

    public function index()
    {
        $allowedColumns = $this->allowedColumns;
        $importResults = ImportResult::relatedEntitiesPeopleOrganization()->latest()->take(20)->get();

        return view('admin.import.related-entities.people-organization.index', compact('allowedColumns', 'importResults'));
    }

    public function import(PeopleOrganisationRequest $request)
    {
        $records = array_map('str_getcsv', file($request->file('csv')));

        $importResult = ImportResult::create([
            'type'    => ImportResult::TYPE_RELATED_ENTITIES_PEOPLE_ORGANIZATION,
            'csv'     => json_encode($records),
            'user_id' => Auth::id(),
        ]);

        $columnIndexes = [];
        $headings      = array_shift($records);

        foreach ($headings as $index => $column) {
            $lowerColumn = strtolower(trim($column));

            if (in_array($lowerColumn, $this->allowedColumns) === false) {
                return redirect()
                    ->back()
                    ->with('error', "Column '$column' is not allowed!");
            }

            $columnIndexes[$lowerColumn] = $index;
        }

        foreach ($records as $record) {
            $companyId = $record[$columnIndexes['organization id']];
            $personData = [
                'name' => $record[$columnIndexes['person name']],
                'email' => $record[$columnIndexes['email']],
                'position' => $record[$columnIndexes['position']],
                'location'  => $record[$columnIndexes['location']],
                'linkedin' => $record[$columnIndexes['linkedin']],
            ];

            $personData = array_map('trim', $personData);

            if (!empty($personData['name'])) {
                ProcessPeopleOrganization::dispatch($importResult, $companyId, $personData);
            }
        }

        return redirect()->route('import.related-entities.people-organization.index')->with('success', 'Import started!');
    }

    public function results($id)
    {
        $result = ImportResult::relatedEntitiesPeopleOrganization()->findOrFail($id);
        $peopleMessages   = json_decode($result->people_messages);
        $locationMessages = json_decode($result->location_messages);
        $csv = json_decode($result->csv);

        return view('admin.import.related-entities.people-organization.results', compact(
            'result',
            'locationMessages',
            'peopleMessages',
            'csv'
        ));
    }

    public function failures($id)
    {
        $result = ImportResult::with('failures')
            ->relatedEntitiesPeopleOrganization()
            ->findorFail($id);
        $failuresTotalByType = [];

        foreach ($result->failures as $failure) {
            if (isset($failuresTotalByType[$failure->type])) {
                $failuresTotalByType[$failure->type]++;
            } else {
                $failuresTotalByType[$failure->type] = 1;
            }
        }

        return view('admin.import.related-entities.people-organization.failures', compact('result', 'failuresTotalByType'));
    }
}
