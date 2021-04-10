<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Backpack\CRUD\Operations\UpdateOperationWithTouching;
use App\Http\Requests\LocationRequest;
use App\Models\Country;
use App\Models\Location;
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
    use UpdateOperationWithTouching;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        if(!backpack_user()->can('edit locations')) {
            abort(404);
        }

        CRUD::setModel(Location::class);
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
        $this->crud->addColumn([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Location',
        ]);
        $this->crud->addColumn([
            'name' => 'city',
            'type' => 'text',
            'label' => 'City',
        ]);
        $this->crud->addColumn([
            'name' => 'region',
            'type' => 'text',
            'label' => 'Region',
        ]);
        $this->crud->addColumn([
            'name' => 'country',
            'type' => 'text',
            'label' => 'Country',
        ]);
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();

        $this->crud->addButtonFromModelFunction('line', 'show_entity', 'getShowEntityPageButton', 'beginning');
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

        $countries = Country::all()->pluck('name', 'name')->toArray();

        $this->crud->addField([
            'name' => 'city',
            'type' => 'text',
            'label' => 'City',
        ]);
        $this->crud->addField([
            'name' => 'region',
            'type' => 'text',
            'label' => 'Region',
        ]);
        $this->crud->addField([
            'name' => 'country',
            'type' => 'select2_from_array',
            'label' => 'Country',
            'options' => [null => ''] + $countries,
            'allows_null' => false,
        ]);
        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Location (auto-populated)',
        ]);

        Widget::add()
            ->to('before_content')
            ->type('locationJavascript')
            ->content('Name field will be auto-populated. City and region are optional.');
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
        $this->crud->addField([
            'name' => 'region_code',
            'type' => 'text',
            'label' => 'Region code',
        ]);
        $this->crud->addField([
            'name' => 'alpha2code',
            'type' => 'text',
            'label' => 'Alpha2 code',
        ]);
    }
}
