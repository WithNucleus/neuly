<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LocationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

/**
 * Class LocationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LocationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \App\Traits\RedirectableUpdateOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {

        // Check Guard
        if(!backpack_user()->can('edit locations')) {
            abort(404);
        }

        CRUD::setModel(\App\Models\Location::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/location');
        CRUD::setEntityNameStrings('location', 'locations');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setFromDb(); // columns

        // Location Name
        $this->crud->addColumn([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Location'
        ]);

        // City
        $this->crud->addColumn([
            'name' => 'city',
            'type' => 'text',
            'label' => 'City'
        ]);

        // Region
        $this->crud->addColumn([
            'name' => 'region',
            'type' => 'text',
            'label' => 'Region'
        ]);

        // Country
        $this->crud->addColumn([
            'name' => 'country',
            'type' => 'text',
            'label' => 'Country'
        ]);

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
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(LocationRequest::class);

        // CRUD::setFromDb(); // fields

        // City
        $this->crud->addField([
            'name' => 'city',
            'type' => 'text',
            'label' => 'City'
        ]);

        // Region
        $this->crud->addField([
            'name' => 'region',
            'type' => 'text',
            'label' => 'Region'
        ]);

        // Country
        $this->crud->addField([
            'name' => 'country',
            'type' => 'text',
            'label' => 'Country'
        ]);

        // Location Name
        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Location (auto-populated)'
        ]);

        Widget::add()
                ->to('before_content')
                ->type('locationJavascript')
                ->content('Name field will be auto-populated. City and region are optional.');

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
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();

    }
}
