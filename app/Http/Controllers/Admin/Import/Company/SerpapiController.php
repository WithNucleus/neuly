<?php

namespace App\Http\Controllers\Admin\Import\Company;

use App\Jobs\Import\Company\SerpapiData as ImportSerpapiData;
use App\Models\Company;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SerpapiController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;

    public function setup()
    {
        $this->crud->setModel(Company::class);
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/import/company/serpapi');
        $this->crud->setEntityNameStrings('organization SerpApi', 'organizations SerpApi');
        $this->crud->enableBulkActions();
    }

    public function setupListOperation()
    {
        $this->crud->addClause('doesntHave', 'serpapiData');
        $this->crud->addColumn(['name' => 'name', 'label' => 'Name', 'type' => 'string']);

        $this->crud->allowAccess('bulkImport');
        $this->crud->addButtonFromView('top', 'bulkImport', 'import.company.bulk_serpapi', 'beginning');
    }

    public function bulkImport(Request $request)
    {
        $ids = $request->input('entries', []);

        $entities = Company::findMany($ids);

        foreach ($entities as $entity) {
            ImportSerpapiData::dispatch($entity);
        }

        return response('', Response::HTTP_OK);
    }
}
