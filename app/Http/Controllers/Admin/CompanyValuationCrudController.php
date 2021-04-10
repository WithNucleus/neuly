<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CompanyValuationRequest;
use App\Models\CompanyValuation;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CompanyValuationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CompanyValuationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        if(!backpack_user()->can('edit companies')) {
            abort(403);
        }

        CRUD::setModel(CompanyValuation::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/companyvaluation');
        CRUD::setEntityNameStrings('organisation valuation', 'organisation valuations');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'label'     => 'Company',
            'name'      => 'company_id',
            'type'      => 'select',
            'entity'    => 'company',
            'attribute' => 'name',
        ]);
        CRUD::addColumn([
            'label'     => 'Acquirer',
            'name'      => 'acquirer_id',
            'type'      => 'select',
            'entity'    => 'acquirer',
            'attribute' => 'name',
        ]);
        CRUD::addColumn([
            'label'    => 'Amount',
            'name'     => 'amount',
            'type'     => 'number',
            'prefix'   => '$',
        ]);
        CRUD::addColumn([
            'label'    => 'Date',
            'name'     => 'date',
            'type'     => 'date',
        ]);
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();

        CRUD::addColumn([
            'label'    => 'Notes',
            'name'     => 'notes',
            'type'     => 'text',
        ]);

        CRUD::addColumn([
            'label'     => 'Investors',
            'type'      => 'select_multiple',
            'name'      => 'investors',
            'entity'    => 'investors',
            'attribute' => 'name',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CompanyValuationRequest::class);

        CRUD::addField([
                'label'     => "Company",
                'type'      => 'select2',
                'name'      => 'company_id',
                'entity'    => 'company',
                'attribute' => 'name',
        ]);
        CRUD::addField([
            'label'     => "Acquirer",
            'type'      => 'select2',
            'name'      => 'acquirer_id',
            'entity'    => 'acquirer',
            'attribute' => 'name',
        ]);
        CRUD::addField([
            'label'    => 'Amount',
            'name'     => 'amount',
            'type'     => 'number',
            'prefix'   => '$',
        ]);
        CRUD::addField([
            'label'    => 'Date',
            'name'     => 'date',
            'type'     => 'date_picker',
            'date_picker_options' => [
                'format' => config('app.datepicker_input_format'),
            ],
        ]);
        CRUD::addField([
            'label'    => 'Notes',
            'name'     => 'notes',
            'type'     => 'textarea',
        ]);

        CRUD::addField([
            'label'     => "Investors",
            'type'      => 'select2_multiple',
            'name'      => 'investors',
            'entity'    => 'investors',
            'attribute' => 'name',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
    }

    public function store()
    {
        $response = $this->traitStore();

        $this->updateCompanyInvestorRelations($this->crud->getCurrentEntry());

        return $response;
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function update()
    {
        $response = $this->traitUpdate();

        $this->updateCompanyInvestorRelations($this->crud->getCurrentEntry());

        return $response;
    }

    /**
     * @param CompanyValuation $companyValuation
     */
    private function updateCompanyInvestorRelations(CompanyValuation $companyValuation)
    {
        $relatedInvestorIds = $companyValuation->investors()->pluck('id');

        if ($relatedInvestorIds) {
            $companyValuation->company->investors()->syncWithoutDetaching($relatedInvestorIds);
            $companyValuation->company->touch();
        }
    }
}
