<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\JobApplicationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class JobApplicationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class JobApplicationCrudController extends CrudController
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
        CRUD::setModel(\App\Models\JobApplication::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/jobapplication');
        CRUD::setEntityNameStrings('job application', 'job applications');

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
            'name'  => 'created_at',
            'label' => 'Date',
            'type'  => 'date',
        ]);

        $this->crud->addColumn([
            'name'  => 'applicant',
            'label' => 'Applicant',
            'type'  => 'model_function',
            'function_name' => 'getApplicantName'
        ]);

        $this->crud->addColumn([
            'name'      => 'job',
            'label'     => 'Job',
            'type'      => 'relationship',
            'entity'    => 'job',
            'attribute' => 'job_title',
            'model'     => App\Models\Job::class,
        ]);

        $this->crud->addColumn([
            'name'      => 'company',
            'label'     => 'Organization',
            'type'      => 'relationship',
            'entity'    => 'company',
            'attribute' => 'name',
            'model'     => App\Models\Company::class,
        ]);

        $this->crud->removeButton('update');
        $this->crud->removeButton('delete');
        $this->crud->removeButton('create');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    protected function setupShowOperation()
    {

        $this->crud->addColumn([
            'name'  => 'created_at',
            'label' => 'Date',
            'type'  => 'date',
        ]);

        $this->crud->addColumn([
            'name'  => 'user_id',
            'label' => 'Applicant',
            'type'  => 'model_function',
            'function_name' => 'getApplicantName'
        ]);

        $this->crud->addColumn([
            'name'  => 'email',
            'label' => 'Applicant Email',
            'type'  => 'model_function',
            'function_name' => 'getApplicantEmail'
        ]);

        $this->crud->addColumn([
            'name'  => 'job_id',
            'label' => 'Job',
            'type'  => 'model_function',
            'function_name' => 'getJobLink'
        ]);

        $this->crud->addColumn([
            'name'  => 'company_id',
            'label' => 'Organization',
            'type'  => 'model_function',
            'function_name' => 'getOrganizationLink'
        ]);

        $this->crud->addColumn([
            'name'  => 'cover_letter',
            'label' => 'Cover Letter',
            'type'  => 'model_function',
            'function_name' => 'getCoverLetter'
        ]);

        $this->crud->addColumn([
            'name'  => 'resume',
            'label' => 'Resume',
            'type'  => 'model_function',
            'function_name' => 'getResume'
        ]);

        $this->crud->removeButton('update');

    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        // CRUD::setValidation(JobApplicationRequest::class);

        // CRUD::setFromDb(); // fields

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
        // $this->setupCreateOperation();
    }
}
