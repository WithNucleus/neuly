<?php

namespace App\Http\Controllers\Admin\Import\ClinicalTrial;

use App\Jobs\Import\ClinicalTrial\ParseDetails;
use App\Models\Clinicaltrial;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ParsingController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;

    public function setup()
    {
        $this->crud->setModel(Clinicaltrial::class);
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/import/clinicaltrial/parsing');
        $this->crud->setEntityNameStrings('clinical trial parsing - entity', 'clinical trials parsing - entities');
        $this->crud->enableBulkActions();
    }

    public function setupListOperation()
    {
        $this->crud->addClause('availableForParsing');
        $this->crud->addColumn(['name' => 'nct_number', 'label' => 'NCT', 'type' => 'string']);
        $this->crud->addColumn(['name' => 'title', 'label' => 'Title', 'type' => 'string']);

        $this->crud->allowAccess('bulkImport');
        $this->crud->addButtonFromView('top', 'bulkImport', 'import.clinicaltrial.bulk_parse', 'beginning');
    }

    public function bulkImport(Request $request)
    {
        $ids = $request->input('entries', []);

        $clinicalTrials = Clinicaltrial::availableForParsing()->findMany($ids);

        foreach ($clinicalTrials as $clinicalTrial) {
            ParseDetails::dispatch($clinicalTrial);
        }

        return response('', Response::HTTP_OK);
    }
}
