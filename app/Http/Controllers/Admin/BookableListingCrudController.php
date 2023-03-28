<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BookableListingCrudRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BookableListingCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BookableListingCrudController extends CrudController
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

        CRUD::setModel(\App\Models\BookableListing::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/bookable-listing');
        CRUD::setEntityNameStrings('bookable listing', 'bookable listings');

        $this->crud->query = $this->crud->query->withoutGlobalScopes();
        $this->crud->model->clearGlobalScopes();
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
        CRUD::column('id');
        CRUD::column('name');
        CRUD::column('bookable_id');
        CRUD::column('type');
        CRUD::column('status');
        $this->crud->addColumn([
            'label' => 'Directories',
            'type' => 'select_multiple',
            'name' => 'directories',
            'entity' => 'directories',
            'attribute' => 'name',
            'model' => \App\Models\Directory::class,
        ]);
        CRUD::column('bookable_type');
        CRUD::column('created_at');
        CRUD::column('updated_at');

        $this->crud->addButtonFromModelFunction('line', 'view', 'backpackViewButton', 'beginning');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
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
        CRUD::setValidation(BookableListingCrudRequest::class);

        CRUD::field('name');
        CRUD::field('type');
        CRUD::field('status');
        CRUD::field('phone');
        CRUD::field('email');
        CRUD::field('address');
        CRUD::field('city');
        CRUD::field('state');
        CRUD::field('latitude');
        CRUD::field('longitude');

        $this->crud->addField([
            'name' => 'start_date',
            'type' => 'date_picker',
            'label' => 'Start Date',
        ]);

        $this->crud->addField([
            'name' => 'end_date',
            'type' => 'date_picker',
            'label' => 'End Date',
        ]);

        $this->crud->addField([
            'label' => 'Directories',
            'type' => 'select2_multiple',
            'name' => 'directories',
            'entity' => 'directories',
            'attribute' => 'name',
            'pivot' => true,
            'select_all' => true,
            'model' => \App\Models\Directory::class,
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
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
