<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InvestorRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

/**
 * Class InvestorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class InvestorCrudController extends CrudController
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

        // Check Guard
        if(!backpack_user()->can('edit investors')) {
            abort(404);
        }

        CRUD::setModel(\App\Models\Investor::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/investor');
        CRUD::setEntityNameStrings('investor', 'investors');

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

        // Name
        $this->crud->addColumn(['name' => 'name']);

        // Type
        $this->crud->addColumn(['name' => 'type']);

        // Website
        $this->crud->addColumn(['name' => 'website']);

        // Website
        // $this->crud->addColumn(['name' => 'website', 'type' => 'text', 'label' => 'Website']);

        // // Location -- Relationship
        // $this->crud->addColumn([
        //    'label'     => 'Location',
        //    'type'      => 'select_multiple',
        //    'name'      => 'locations',
        //    'entity'    => 'locations',
        //    'attribute' => 'name',
        //    'model'     => 'App\Models\Location',
        //    // 'orderable' => true,
        //    'options'   => (function ($query) {
        //         return $query->orderBy('name', 'ASC')->get();
        //     }),
        // ]);

        // Focus -- Relationship
        // $this->crud->addColumn([
        //    'label'     => 'Focus',
        //    'type'      => 'select_multiple',
        //    'name'      => 'focus',
        //    'entity'    => 'focus',
        //    'attribute' => 'name',
        //    'model'     => 'App\Models\Focus',
        //    // 'orderable' => true,
        //    'options'   => (function ($query) {
        //         return $query->orderBy('name', 'ASC')->get();
        //     }),
        // ]);

        // Companies -- Relationship
        // $this->crud->addColumn([
        //    'label'     => 'Companies',
        //    'type'      => 'select_multiple',
        //    'name'      => 'companies',
        //    'entity'    => 'companies',
        //    'attribute' => 'name',
        //    'model'     => 'App\Models\Company',
        //    // 'orderable' => true,
        //    'options'   => (function ($query) {
        //         return $query->orderBy('name', 'ASC')->get();
        //     }),
        // ]);

        // People -- Relationship
        // $this->crud->addColumn([
        //    'label'     => 'People',
        //    'type'      => 'select_multiple',
        //    'name'      => 'people',
        //    'entity'    => 'people',
        //    'attribute' => 'name',
        //    'model'     => 'App\Models\Person',
        //    // 'orderable' => true,
        //    'options'   => (function ($query) {
        //         return $query->orderBy('name', 'ASC')->get();
        //     }),
        // ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Show operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupShowOperation()
    {
        $request = \Request::getPathInfo();
        $request_array = explode('/', $request);
        $this_investor_id = $request_array[3];
        $investor = \App\Models\Investor::find($this_investor_id);

        // Company People Widget
        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.investor_show_widget',
            'investor' => $investor
        ])->to('after_content');

        $this->setupListOperation();

        // Companies -- Relationship
        $this->crud->addColumn([
           'label'     => 'Companies',
           'type'      => 'select_multiple',
           'name'      => 'companies',
           'entity'    => 'companies',
           'attribute' => 'name',
           'model'     => 'App\Models\Company',
           // 'orderable' => true,
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        // Location Relationship
        $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
             'label'     => "Locations",
             'type'      => 'select2_multiple',
             'name'      => 'locations', // the method that defines the relationship in your Model
             'entity'    => 'locations', // the method that defines the relationship in your Model
             'attribute' => 'name', // foreign key attribute that is shown to user

             'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
             // 'select_all' => true, // show Select All and Clear buttons?
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),

             // optional
             'model'     => "App\Models\Location", // foreign key model
        ]);

        // People -- Relationship
        $this->crud->addColumn([
           'label'     => 'People',
           'type'      => 'select_multiple',
           'name'      => 'people',
           'entity'    => 'people',
           'attribute' => 'name',
           'model'     => 'App\Models\Person',
           // 'orderable' => true,
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        // Logo
        $this->crud->addColumn([
            'label'        => "Logo",
            'name'         => "logo",
            'type'         => 'image',
            'prefix'       => 'storage/'
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
        CRUD::setValidation(InvestorRequest::class);

        // CRUD::setFromDb(); // fields

        // Name
        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Name'
        ]);

        // Website
        $this->crud->addField([
            'name' => 'website',
            'type' => 'text',
            'label' => 'Website'
        ]);

        // Type
        $this->crud->addField([
            'name' => 'type',
            'type' => 'radio',
            'label' => 'Type',
            'options'     => [
                'Venture Capital' => 'Venture Capital',
                'Private Equity' => 'Private Equity',
                'Private Individual' => 'Private Individual',
            ],
            'inline' => true,
        ]);

        // Location Relationship
        $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
             'label'     => "Locations",
             'type'      => 'select2_multiple',
             'name'      => 'locations', // the method that defines the relationship in your Model
             'entity'    => 'locations', // the method that defines the relationship in your Model
             'attribute' => 'name', // foreign key attribute that is shown to user

             'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
             // 'select_all' => true, // show Select All and Clear buttons?
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),

             // optional
             'model'     => "App\Models\Location", // foreign key model
        ]);

        // Company Relationship
        $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
             'label'     => "Companies",
             'type'      => 'select2_multiple',
             'name'      => 'companies', // the method that defines the relationship in your Model
             'entity'    => 'companies', // the method that defines the relationship in your Model
             'attribute' => 'name', // foreign key attribute that is shown to user

             'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
             // 'select_all' => true, // show Select All and Clear buttons?
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),

             // optional
             'model'     => "App\Models\Company", // foreign key model
        ]);

        // Person Relationship
        $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
             'label'     => "People",
             'type'      => 'select2_multiple',
             'name'      => 'people', // the method that defines the relationship in your Model
             'entity'    => 'people', // the method that defines the relationship in your Model
             'attribute' => 'name', // foreign key attribute that is shown to user

             'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
             // 'select_all' => true, // show Select All and Clear buttons?
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),

             // optional
             'model'     => "App\Models\Person", // foreign key model
        ]);

        // Logo
        $this->crud->addField([
            'label'        => "Logo",
            'name'         => "logo",
            'type'         => 'image',
            'upload'       => true,
            'crop'         => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 0, // ommit or set to 0 to allow any aspect ratio
            'disk'      => 'local', // in case you need to show images from a different disk
            // 'prefix'    => 'storage/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
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
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
