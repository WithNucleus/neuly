<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\JobRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

/**
 * Class JobCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class JobCrudController extends CrudController
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
        if(!backpack_user()->can('edit jobs')) {
            abort(404);
        }

        CRUD::setModel(\App\Models\Job::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/job');
        CRUD::setEntityNameStrings('job', 'jobs');
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

        // Job Title
        $this->crud->addColumn(['name' => 'job_title', 'type' => 'text', 'label' => 'Job Title']);

        // Posted Date
        $this->crud->addColumn(['name' => 'posted_date', 'type' => 'date', 'label' => 'Posted Date']);

        // Employment Type
        $this->crud->addColumn(['name' => 'employment_type', 'type' => 'text', 'label' => 'Employment Type']);
    }

    /**
     * Define what happens when the Show operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupShowOperation()
    {

        // $this->crud->set('show.setFromDb', false);

        // Job Title
        $this->crud->addColumn(
            ['name' => 'job_title',
            'type' => 'text',
            'label' => 'Job Title'
        ]);

        // Posted Date
        $this->crud->addColumn([
            'name' => 'posted_date',
            'type' => 'date',
            'label' => 'Posted Date'
        ]);

        // Company Relationship
        $this->crud->addColumn([
             'label'     => "Organization",
             'type'      => 'select',
             'name'      => 'company_id',
             'entity'    => 'company',
             'attribute' => 'name',
             'model'     => "App\Models\Company",
        ]);

        // Employment Type
        $this->crud->addColumn([
            'name' => 'employment_type',
            'type' => 'text',
            'label' => 'Employment Type'
        ]);

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

    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(JobRequest::class);

        // CRUD::setFromDb(); // fields

        // Update Slug Widget
        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.updateSlug',
            'field_name' => 'job_title' // field name to generate slug
        ])->to('before_content');

        // Job Title
        $this->crud->addField([
            'name' => 'job_title',
            'type' => 'text',
            'label' => 'Job Title'
        ]);

        // Page Slug
        $this->crud->addField([
            'name' => 'slug',
            'type' => 'text',
            'label' => 'Page Slug'
        ]);

        // Posted Date
        $this->crud->addField([
            'name' => 'posted_date',
            'type' => 'date',
            'label' => 'Posted Date'
        ]);

        // Company Relationship
        $this->crud->addField([
             'label'     => "Organization",
             'type'      => 'select2',
             'name'      => 'company_id',
             'entity'    => 'company',
             'attribute' => 'name',
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
             'model'     => "App\Models\Company",
        ]);

        // Employment Type
        $this->crud->addField([
            'name' => 'employment_type',
            'type' => 'radio',
            'label' => 'Employment Type',
            'options'     => [
                'Full Time' => 'Full Time',
                'Part Time' => 'Part Time',
                'One Time' => 'One Time',
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
             'model'     => "App\Models\Location",
        ]);

        // Focus
        $this->crud->addField([
             'label'     => "Focus",
             'type'      => 'select2_multiple',
             'name'      => 'focus',
             'entity'    => 'focus',
             'attribute' => 'name',
             'pivot'     => true,
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
             'model'     => "App\Models\Focus",
        ]);

        // Job Description
        $this->crud->addField([
            'name' => 'job_description',
            'type' => 'wysiwyg',
            'label' => 'Job Description'
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
