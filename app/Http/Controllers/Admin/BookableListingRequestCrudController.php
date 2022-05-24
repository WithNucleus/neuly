<?php

namespace App\Http\Controllers\Admin;

use App\Models\BookableListing;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BookableListingRequestCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BookableListingRequestCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
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
            abort(404);
        }

        CRUD::setModel(\App\Models\BookableListingRequest::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/bookable-listing-request');
        CRUD::setEntityNameStrings('bookable listing request', 'bookable listing requests');
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
            'type' => 'datetime',
            'label' => 'Date',
            'name' => 'created_at'
        ]);

        $this->crud->addColumn([
            'type' => 'text',
            'label' => 'Name',
            'name' => 'full_name'
        ]);

        $this->crud->addColumn([
            'name'         => 'bookable_listing',
            'type'         => 'relationship',
            'label'        => 'Bookable Listing',
             'entity'    => 'bookableListing',
             'attribute' => 'name',
             'model'     => BookableListing::class,
        ]);

        $this->crud->addColumn([
            'type' => 'text',
            'label' => 'Email',
            'name' => 'email'
        ]);

        $this->crud->addColumn([
            'type' => 'text',
            'label' => 'Phone',
            'name' => 'phone'
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }
}
