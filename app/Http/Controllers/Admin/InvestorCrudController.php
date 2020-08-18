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

        $this->crud->addColumn(['name' => 'name']);
        $this->crud->addColumn(['name' => 'type']);
        $this->crud->addColumn(['name' => 'website']);

        $this->crud->addColumn([
            'name' => 'created_at',
            'type' => 'date'
        ]);
        
        $this->crud->addColumn([
            'name' => 'updated_at',
            'type' => 'date'
        ]);

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
        ])->to('before_content');

        $this->setupListOperation();

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
        $this->crud->addField([
             'label'     => "Locations",
             'type'      => 'select2_multiple',
             'name'      => 'locations',
             'entity'    => 'locations',
             'attribute' => 'name',
             'pivot'     => true,
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'model'     => "App\Models\Location", // foreign key model
        ]);

        // Company Relationship
        $this->crud->addField([
             'label'     => "Companies",
             'type'      => 'select2_multiple',
             'name'      => 'companies',
             'entity'    => 'companies',
             'attribute' => 'name',
             'pivot'     => true,
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'model'     => "App\Models\Company",
        ]);

        // Logo
        $this->crud->addField([
            'label'        => "Logo",
            'name'         => "logo",
            'type'         => 'image',
            'upload'       => true,
            'crop'         => true,
            'aspect_ratio' => 0,
            'disk'      => 'local',
        ]);

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
