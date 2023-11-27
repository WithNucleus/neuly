<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\JobRequest;
use App\Models\EmploymentType;
use App\Models\Job;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

class JobCrudController extends CrudController
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
        if (! backpack_user()->can('edit jobs')) {
            abort(404);
        }

        CRUD::setModel(Job::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/job');
        CRUD::setEntityNameStrings('job', 'jobs');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'job_title', 'type' => 'text', 'label' => 'Job Title']);
        $this->crud->addColumn(['name' => 'owner', 'type' => 'relationship', 'label' => 'Owner', 'attribute' => 'name']);
        $this->crud->addColumn(['name' => 'status', 'type' => 'text', 'label' => 'Status']);
        $this->crud->addColumn(['name' => 'posted_date', 'type' => 'date', 'label' => 'Posted Date']);
        $this->crud->addColumn([
            'label' => 'Employment Type',
            'type' => 'relationship',
            'name' => 'employmentTypes',
            'attribute' => 'name',
        ]);
        $this->crud->addColumn(['name' => 'salary', 'label' => 'Salary', 'type' => 'number', 'prefix' => '$']);
        $this->crud->addColumn(['name' => 'salary_max', 'label' => 'Salary (Max)', 'type' => 'number', 'prefix' => '$']);
        $this->crud->addColumn(['name' => 'hourly_rate', 'label' => 'Hourly Rate', 'type' => 'number', 'prefix' => '$', 'decimals' => 2]);
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();

        $this->crud->addColumn([
            'label' => 'Focus',
            'type' => 'relationship',
            'name' => 'focus',
            'attribute' => 'name',
        ]);
        $this->crud->addColumn([
            'label' => 'Location',
            'type' => 'relationship',
            'name' => 'locations',
            'attribute' => 'name',
        ]);

        $this->crud->addButtonFromModelFunction('line', 'show_entity', 'getShowEntityPageButton', 'beginning');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(JobRequest::class);

        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.updateSlug',
            'field_name' => 'job_title',
        ])->to('before_content');

        $this->crud->addField([
            'name' => 'job_title',
            'type' => 'text',
            'label' => 'Job Title',
        ]);

        $this->crud->addField([
            'name' => 'slug',
            'type' => 'text',
            'label' => 'Page Slug',
        ]);

        $this->crud->addField([
            'name' => 'posted_date',
            'type' => 'date_picker',
            'label' => 'Posted Date',
            'date_picker_options' => [
                'format' => config('app.datepicker_input_format'),
            ],
        ]);

        $this->crud->addField([
            'name' => 'url',
            'type' => 'url',
            'label' => 'URL / Apply Link',
        ]);

        $this->crud->addField([
            'name' => 'status',
            'type' => 'select_from_array',
            'label' => 'Status',
            'options' => Job::STATUS_VALUES,
        ]);

        $this->crud->addField([
            'name' => 'salary',
            'label' => 'Salary',
            'type' => 'number',
            'prefix' => '$',
        ]);

        $this->crud->addField([
            'name' => 'salary_max',
            'label' => 'Salary (Max)',
            'type' => 'number',
            'prefix' => '$',
        ]);

        $this->crud->addField([
            'name' => 'hourly_rate',
            'label' => 'Hourly Rate',
            'type' => 'number',
            'prefix' => '$',
            'attributes' => ['step' => '.01'],
        ]);

        CRUD::field('owner')
            ->addMorphOption('App\Models\Company')
            ->addMorphOption('App\Models\Investor');

        $this->crud->addField([
            'label' => 'Employment Type',
            'type' => 'select2_multiple',
            'name' => 'employmentTypes',
            'entity' => 'employmentTypes',
            'attribute' => 'name',
            'pivot' => true,
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'model' => \App\Models\EmploymentType::class,
        ]);

        $this->crud->addField([
            'label' => 'Locations',
            'type' => 'select2_multiple',
            'name' => 'locations',
            'entity' => 'locations',
            'attribute' => 'name',
            'pivot' => true,
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'model' => \App\Models\Location::class,
        ]);

        $this->crud->addField([
            'label' => 'Focus',
            'type' => 'select2_multiple',
            'name' => 'focus',
            'entity' => 'focus',
            'attribute' => 'name',
            'pivot' => true,
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'model' => \App\Models\Focus::class,
        ]);

        $this->crud->addField([
            'name' => 'job_description',
            'type' => 'wysiwyg',
            'label' => 'Job Description',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
