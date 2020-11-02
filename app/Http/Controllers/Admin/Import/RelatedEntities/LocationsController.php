<?php

namespace App\Http\Controllers\Admin\Import\RelatedEntities;

use App\Helpers\EntityHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Import\RelatedEntities\LocationsRequest;
use App\Jobs\Import\RelatedEntities\ProcessLocation;
use App\Models\ImportResult;
use Illuminate\Support\Facades\Auth;

class LocationsController extends Controller
{
    private $allowedColumns = [
        'id',
        'name',
        'locations'
    ];

    public function index()
    {
        $importResults  = ImportResult::relatedEntitiesLocations()->latest()->take(20)->get();
        $entityTypes    = EntityHelper::getLocationRelatedEntities();
        $allowedColumns = $this->allowedColumns;

        return view('admin.import.related-entities.locations.index',
            compact('entityTypes', 'importResults', 'allowedColumns'));
    }

    public function import(LocationsRequest $request)
    {
        $entityClass = $request->input('entity_type');
        $records     = array_map('str_getcsv', file($request->file('csv')));

        $importResult = ImportResult::create([
            'type'    => ImportResult::TYPE_RELATED_ENTITIES_LOCATION,
            'entity'  => $entityClass,
            'csv'     => json_encode($records),
            'user_id' => Auth::id(),
        ]);

        $headings      = array_shift($records);
        $columnIndexes = [];

        foreach ($headings as $index => $column) {
            $lowerColumn = strtolower($column);

            if (in_array($lowerColumn, $this->allowedColumns) === false) {
                return redirect()
                    ->back()
                    ->with('error', "Column '$column' is not allowed!");
            }

            $columnIndexes[$lowerColumn] = $index;
        }

        foreach ($records as $record) {
            $entityId  = $record[$columnIndexes['id']];
            $locations = explode('|', $record[$columnIndexes['locations']]);

            if ($locations !== []) {
                ProcessLocation::dispatch($importResult, $entityClass, $entityId, $locations);
            }
        }

        return redirect()->route('import.related-entities.locations.index')->with('success', 'Import started!');
    }

    public function results($id)
    {
        $result           = ImportResult::relatedEntitiesLocations()->findOrFail($id);
        $peopleMessages   = json_decode($result->people_messages);
        $locationMessages = json_decode($result->location_messages);
        $companyMessages  = json_decode($result->company_messages);
        $csv              = json_decode($result->csv);

        return view('admin.import.related-entities.locations.results', compact(
            'result',
            'locationMessages',
            'companyMessages',
            'peopleMessages',
            'csv'
        ));
    }

    public function failures($id)
    {
        $result              = ImportResult::with('failures')
            ->relatedEntitiesLocations()
            ->findorFail($id);
        $failuresTotalByType = [];

        foreach ($result->failures as $failure) {
            if (isset($failuresTotalByType[$failure->type])) {
                $failuresTotalByType[$failure->type]++;
            } else {
                $failuresTotalByType[$failure->type] = 1;
            }
        }

        return view('admin.import.related-entities.locations.failures', compact('result', 'failuresTotalByType'));
    }
}
