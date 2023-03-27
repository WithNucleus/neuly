<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CompanyBranchRequest;
use App\Models\Company;
use App\Models\Location;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CompanyBranchCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CompanyBranchCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        if (! backpack_user()->can('edit companies')) {
            abort(404);
        }

        CRUD::setModel(\App\Models\CompanyBranch::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/companybranch');
        CRUD::setEntityNameStrings('Company Branch', 'Company Branches');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     *
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'company_id',
            'type' => 'relationship',
            'label' => 'Company',
            'entity' => 'company',
            'attribute' => 'name',
            'model' => Company::class,
        ]);

        $this->crud->addColumn([
            'name' => 'location_id',
            'type' => 'relationship',
            'label' => 'Location',
            'entity' => 'location',
            'attribute' => 'name',
            'model' => Location::class,
        ]);

        $this->crud->addColumn([
            'name' => 'phone',
            'type' => 'phone',
            'label' => 'Phone',
        ]);
    }

    /**
     * Define what happens when the Show operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-show
     *
     * @return void
     */
    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     *
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CompanyBranchRequest::class);

        $this->crud->addField([
            'label' => 'Organization',
            'type' => 'select2',
            'name' => 'company_id',
            'entity' => 'company',
            'model' => \App\Models\Company::class,
            'attribute' => 'name',
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        $this->crud->addField([
            'label' => 'Location',
            'type' => 'select2',
            'name' => 'location_id',
            'entity' => 'location',
            'model' => \App\Models\Location::class,
            'attribute' => 'name',
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        $this->crud->addField([
            'name' => 'address',
            'type' => 'text',
            'label' => 'Address',
        ]);

        $this->crud->addField([
            'name' => 'address2',
            'type' => 'text',
            'label' => 'Address Line 2',
        ]);

        $this->crud->addField([
            'name' => 'phone',
            'type' => 'text',
            'label' => 'Phone',
        ]);

        $this->crud->addField([
            'name' => 'hours',
            'type' => 'text',
            'label' => 'Hours',
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     *
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
