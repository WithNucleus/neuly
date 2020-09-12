<?php

namespace App\Http\Controllers\Admin\Import;

use App\Helpers\EntityHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Import\RelatedEntitiesRequest;
use App\Jobs\Import\RelatedEntities\ProcessLocation;
use App\Models\Focus;
use App\Models\ImportResult;
use App\Models\Location;
use App\Models\Research;
use Illuminate\Support\Facades\Auth;

class RelatedEntitiesController extends Controller
{
    public function index()
    {
        $importResults = ImportResult::relatedEntities()->latest()->take(20)->get();
        $entityTypes   = EntityHelper::getEntities();

        //TODO: for now skip entities without "locations" relation, because in first version script will import only Locations
        $skipEntities = [
            Focus::class,
            Location::class,
            Research::class,
        ];

        foreach ($entityTypes as $key => $entity) {
            if (in_array($entity, $skipEntities)) {
                unset($entityTypes[$key]);
            }
        }

        return view('admin.import.related-entities.index', compact('entityTypes', 'importResults'));
    }

    public function import(RelatedEntitiesRequest $request)
    {
        $allowedColumns = [
            'id',
            'name',
            'locations'
        ];

        $entityClass = $request->input('entity_type');
        $records = array_map('str_getcsv', file($request->file('csv')));

        $importResult = ImportResult::create([
            'type'    => ImportResult::TYPE_RELATED_ENTITIES,
            'entity'  => $entityClass,
            'csv'     => json_encode($records),
            'user_id' => Auth::id(),
        ]);

        $headings      = array_shift($records);
        $columnIndexes = [];

        foreach ($headings as $index => $column) {
            $lowerColumn = strtolower($column);

            if (in_array($lowerColumn, $allowedColumns) === false) {
                return redirect()
                    ->back()
                    ->with('error', "Column '$column' is not allowed! Allowed columns are: " . explode(', ', $allowedColumns) . ".");
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

        return redirect()->route('import.related-entities.index')->with('success', 'Import started!');
    }

    public function results($id)
    {
        $result = ImportResult::findOrFail($id);
        $peopleMessages   = json_decode($result->people_messages);
        $locationMessages = json_decode($result->location_messages);
        $companyMessages  = json_decode($result->company_messages);
        $csv = json_decode($result->csv);

        // Return View to Add People and Relationships
        return view('admin.import.related-entities.results', compact(
            'result',
            'locationMessages',
            'companyMessages',
            'peopleMessages',
            'csv'
        ));
    }

    public function failures($id)
    {
        $result              = ImportResult::with('failures')->findorFail($id);
        $failuresTotalByType = [];

        foreach ($result->failures as $failure) {
            if (isset($failuresTotalByType[$failure->type])) {
                $failuresTotalByType[$failure->type]++;
            } else {
                $failuresTotalByType[$failure->type] = 1;
            }
        }

        return view('admin.import.related-entities.failures', compact('result', 'failuresTotalByType'));
    }
}
