<?php

namespace App\Http\Controllers\Admin;

use App\Models\JobApplication;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class JobApplicationCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class JobApplicationCrudController extends CrudController
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
        if (! backpack_user()->can('view job applications')) {
            abort(403);
        }

        CRUD::setModel(JobApplication::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/jobapplication');
        CRUD::setEntityNameStrings('job application', 'job applications');
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
        $this->crud->addColumn([
            'name' => 'created_at',
            'label' => 'Date',
            'type' => 'date',
        ]);
        $this->crud->addColumn([
            'name' => 'applicantName',
            'label' => 'Applicant',
            'type' => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'job',
            'label' => 'Job',
            'type' => 'relationship',
            'entity' => 'job',
            'attribute' => 'job_title',
            'model' => 'App\Models\Job',
        ]);
        $this->crud->addColumn([
            'name' => 'owner',
            'label' => 'Owner', // Table column heading
            'type' => 'model_function',
            'function_name' => 'getOwnerName',
        ]);
    }

    protected function setupShowOperation()
    {
        $this->crud->addColumn([
            'name' => 'created_at',
            'label' => 'Date',
            'type' => 'date',
        ]);
        $this->crud->addColumn([
            'name' => 'applicantName',
            'label' => 'Applicant',
            'type' => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'email',
            'label' => 'Applicant Email',
            'type' => 'model_function',
            'function_name' => 'getApplicantEmail',
        ]);
        $this->crud->addColumn([
            'name' => 'job_id',
            'label' => 'Job',
            'type' => 'model_function',
            'function_name' => 'getJobLink',
        ]);
        $this->crud->addColumn([
            'name' => 'owner',
            'label' => 'Owner',
            'type' => 'model_function',
            'function_name' => 'getOwnerLink',
        ]);
        $this->crud->addColumn([
            'name' => 'cover_letter',
            'label' => 'Cover Letter',
            'type' => 'model_function',
            'function_name' => 'getCoverLetter',
        ]);
        $this->crud->addColumn([
            'name' => 'resume',
            'label' => 'Resume',
            'type' => 'model_function',
            'function_name' => 'getResume',
        ]);
    }
}
