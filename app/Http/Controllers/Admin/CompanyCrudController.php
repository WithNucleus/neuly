<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CompanyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Focus;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Support\Facades\Route;

/**
 * Class CompanyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CompanyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {

        // Check Guard
        if(!backpack_user()->can('edit companies')) {
            abort(404);
        }

        $this->crud->setModel('App\Models\Company');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/company');
        $this->crud->setEntityNameStrings('organization', 'organizations');

        // dump(Route::currentRouteName());

        // List
        $this->crud->operation('list', function() {

            // Name
            $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);

            // Website
            // $this->crud->addColumn(['name' => 'website', 'type' => 'text', 'label' => 'Website']);

            // Focus -- Relationship
            $this->crud->addColumn([
               'label'     => 'Focus',
               'type'      => 'select_multiple',
               'name'      => 'focus',
               'entity'    => 'focus',
               'attribute' => 'name',
               'model'     => 'App\Models\Focus',
               // 'orderable' => true,
               'options'   => (function ($query) {
                    return $query->orderBy('name', 'ASC')->get();
                }),
            ]);

            // Focus Description
            // $this->crud->addColumn(['name' => 'focus_description', 'type' => 'text', 'label' => 'Focus Description']);

            // Type
            $this->crud->addColumn(['name' => 'ownership', 'type' => 'text', 'label' => 'Type']);

            // Location
            // $this->crud->addColumn(['name' => 'location', 'type' => 'text', 'label' => 'Location']);

            // Location -- Relationship
            $this->crud->addColumn([
               'label'     => 'Location',
               'type'      => 'select_multiple',
               'name'      => 'locations',
               'entity'    => 'locations',
               'attribute' => 'name',
               'model'     => 'App\Models\Location',
               // 'orderable' => true,
               'options'   => (function ($query) {
                    return $query->orderBy('name', 'ASC')->get();
                }),
            ]);

            // People -- When it's Many to Many Relationship
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

        });

    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        // Get this ID
        $request = \Request::getPathInfo();
        $request_array = explode('/', $request);
        $this_company_id = $request_array[3];

        // Get this Company
        $company = \App\Models\Company::find($this_company_id);

        // Company People Widget
        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.company_show_widget',
            'company' => $company
        ])->to('before_content');

        // Ownership
        $this->crud->addColumn('ownership');

        // Ticker Symbol
        $this->crud->addColumn('ticker_symbol');

        // Founded Date
        $this->crud->addColumn([
            'name' => 'founded_date',
            'type' => 'date',
            'label' => 'Founded Date'
        ]);

        // Valuation
        $this->crud->addColumn([
            'name' => 'valuation',
            'type' => 'number',
            'label' => 'Valuation',
            'prefix'     => "$",
        ]);

        // Total Funding Amount
        $this->crud->addColumn([
            'name' => 'total_funding_amount',
            'type' => 'number',
            'label' => 'Total Funding Amount',
            'prefix'     => "$",
        ]);

        // Last Funding Date
        $this->crud->addColumn([
            'name' => 'last_funding_date',
            'type' => 'date',
            'label' => 'Last Funding Date'
        ]);

        // Number Employees
        $this->crud->addColumn([
            'name' => 'number_employees',
            'type' => 'number',
            'label' => '# of Employees'
        ]);

        // Summary
        $this->crud->addColumn([
            'name' => 'summary',
            'type' => 'textarea',
            'label' => 'Summary'
        ]);

        // Notes
        $this->crud->addColumn([
            'name' => 'notes',
            'type' => 'textarea',
            'label' => 'Notes'
        ]);

        // Logo
        $this->crud->addColumn([
            'label'        => "Logo",
            'name'         => "logo",
            'type'         => 'image',
            'prefix'       => 'storage/'
        ]);

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(CompanyRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();

        // Name
        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Name'
        ]);

        // Page Slug
        // $this->crud->addField([
        //     'name' => 'slug',
        //     'type' => 'text',
        //     'label' => 'Page Slug',
        //     'hint' => 'No spaces, use - to separate words',
        // ]);

        // Ownership
        $this->crud->addField([
            'name' => 'ownership',
            'type' => 'radio',
            'label' => 'Type',
            'options'     => [
                'Public Company' => 'Public Company',
                'Privately Held' => 'Privately Held',
                'Educational Institution' => 'Educational Institution',
                'Government Agency' => 'Government Agency',
                'Non-Profit' => 'Non-Profit'
            ],
            'inline' => true,
        ]);

        // Focus
        $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
             'label'     => "Focus",
             'type'      => 'select2_multiple',
             'name'      => 'focus', // the method that defines the relationship in your Model
             'entity'    => 'focus', // the method that defines the relationship in your Model
             'attribute' => 'name', // foreign key attribute that is shown to user

             'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
             // 'select_all' => true, // show Select All and Clear buttons?
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),

             // optional
             'model'     => "App\Models\Focus", // foreign key model
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

        // People
        // $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
        //      'label'     => "People",
        //      'type'      => 'select2_multiple',
        //      'name'      => 'people', // the method that defines the relationship in your Model
        //      'entity'    => 'people', // the method that defines the relationship in your Model
        //      'attribute' => 'name', // foreign key attribute that is shown to user

        //      'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
        //      // 'select_all' => true, // show Select All and Clear buttons?
        //      'options'   => (function ($query) {
        //         return $query->orderBy('name', 'ASC')->get();
        //     }),

        //      // optional
        //      'model'     => "App\Models\Person", // foreign key model
        // ]);

        // $this->crud->addField([
        //     'name' => 'people_relationship',
        //     'label' => 'People',
        //     'type' => 'repeatable',
        //     'fields' => [
        //         [
        //             'label'     => 'People',
        //             'type'      => 'select2',
        //             'name'      => 'person',
        //             'entity'    => 'people',
        //             'attribute' => 'name',
        //             'options'   => (function ($query) {
        //                 return $query->orderBy('name', 'ASC')->get();
        //             }),
        //             'model'     => "App\Models\Person",
        //             'wrapper' => ['class' => 'form-group col-md-6'],
        //         ],
        //         [
        //             'name' => 'position',
        //             'type' => 'text',
        //             'label' => 'Position',
        //             'wrapper' => ['class' => 'form-group col-md-6'],
        //         ]
        //     ]
        // ]);

        // Investor Relationship
        $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
             'label'     => "Investors",
             'type'      => 'select2_multiple',
             'name'      => 'investors', // the method that defines the relationship in your Model
             'entity'    => 'investors', // the method that defines the relationship in your Model
             'attribute' => 'name', // foreign key attribute that is shown to user

             'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
             // 'select_all' => true, // show Select All and Clear buttons?
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),

             // optional
             'model'     => "App\Models\Investor", // foreign key model
        ]);

        // Ticker Symbol
        $this->crud->addField([
            'name' => 'ticker_symbol',
            'type' => 'text',
            'label' => 'Ticker Symbol'
        ]);

        // Website
        $this->crud->addField([
            'name' => 'website',
            'type' => 'text',
            'label' => 'Website'
        ]);

        // Founded Date
        $this->crud->addField([
            'name' => 'founded_date',
            'type' => 'date',
            'label' => 'Founded Date'
        ]);

        // Valuation
        $this->crud->addField([
            'name' => 'valuation',
            'type' => 'number',
            'label' => 'Valuation',
            'prefix'     => "$",
        ]);

        // Total Funding Amount
        $this->crud->addField([
            'name' => 'total_funding_amount',
            'type' => 'number',
            'label' => 'Total Funding Amount',
            'prefix'     => "$",
        ]);

        // Last Funding Date
        $this->crud->addField([
            'name' => 'last_funding_date',
            'type' => 'date',
            'label' => 'Last Funding Date'
        ]);

        // Number Employees
        $this->crud->addField([
            'name' => 'number_employees',
            'type' => 'number',
            'label' => '# of Employees'
        ]);

        // Summary
        $this->crud->addField([
            'name' => 'summary',
            'type' => 'textarea',
            'label' => 'Summary'
        ]);

        // Notes
        $this->crud->addField([
            'name' => 'notes',
            'type' => 'textarea',
            'label' => 'Notes'
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
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
