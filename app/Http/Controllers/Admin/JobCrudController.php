<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendNotification;
use App\Http\Requests\JobRequest;
use App\Models\Company;
use App\Models\Focus;
use App\Models\Job;
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
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        if(!backpack_user()->can('edit jobs')) {
            abort(404);
        }

        CRUD::setModel(Job::class);
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
        $this->crud->addColumn(['name' => 'job_title', 'type' => 'text', 'label' => 'Job Title']);
        $this->crud->addColumn(['name' => 'posted_date', 'type' => 'date', 'label' => 'Posted Date']);
        $this->crud->addColumn(['name' => 'employment_type', 'type' => 'text', 'label' => 'Employment Type']);
        $this->crud->addColumn(['name' => 'salary', 'label' => 'Salary', 'type' => 'number', 'prefix' => '$']);
        $this->crud->addColumn(['name' => 'hourly_rate', 'label' => 'Hourly Rate', 'type' => 'number', 'prefix' => '$', 'decimals' => 2]);
    }

    /**
     * Define what happens when the Show operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupShowOperation()
    {
        $this->crud->addColumn(
            ['name' => 'job_title',
            'type' => 'text',
            'label' => 'Job Title'
        ]);
        $this->crud->addColumn([
            'name' => 'posted_date',
            'type' => 'date',
            'label' => 'Posted Date'
        ]);
        $this->crud->addColumn([
             'label'     => "Organization",
             'type'      => 'select',
             'name'      => 'company_id',
             'entity'    => 'company',
             'attribute' => 'name',
             'model'     => "App\Models\Company",
        ]);
        $this->crud->addColumn([
            'name' => 'employment_type',
            'type' => 'text',
            'label' => 'Employment Type'
        ]);
        $this->crud->addColumn([
            'name' => 'salary',
            'label' => 'Salary',
            'type' => 'number',
            'prefix' => '$',
        ]);
        $this->crud->addColumn([
            'name' => 'hourly_rate',
            'label' => 'Hourly Rate',
            'type' => 'number',
            'prefix' => '$',
            'decimals' => 2,
        ]);
        $this->crud->addColumn([
           'label'     => 'Focus',
           'type'      => 'select_multiple',
           'name'      => 'focus',
           'entity'    => 'focus',
           'attribute' => 'name',
           'model'     => 'App\Models\Focus',
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        $this->crud->addColumn([
           'label'     => 'Location',
           'type'      => 'select_multiple',
           'name'      => 'locations',
           'entity'    => 'locations',
           'attribute' => 'name',
           'model'     => 'App\Models\Location',
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

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
        CRUD::setValidation(JobRequest::class);

        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.updateSlug',
            'field_name' => 'job_title'
        ])->to('before_content');

        $this->crud->addField([
            'name'  => 'job_title',
            'type'  => 'text',
            'label' => 'Job Title'
        ]);
        $this->crud->addField([
            'name'  => 'slug',
            'type'  => 'text',
            'label' => 'Page Slug'
        ]);
        $this->crud->addField([
            'name'  => 'posted_date',
            'type'  => 'date',
            'label' => 'Posted Date'
        ]);
        $this->crud->addField([
            'name'   => 'salary',
            'label'  => 'Salary',
            'type'   => 'number',
            'prefix' => "$",
        ]);
        $this->crud->addField([
            'name'       => 'hourly_rate',
            'label'      => 'Hourly Rate',
            'type'       => 'number',
            'prefix'     => "$",
            'attributes' => ["step" => ".01"]
        ]);
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
        $this->crud->addField([
            'name'    => 'employment_type',
            'type'    => 'radio',
            'label'   => 'Employment Type',
            'options' => [
                'Full Time' => 'Full Time',
                'Part Time' => 'Part Time',
                'One Time'  => 'One Time',
            ],
            'inline'  => true,
        ]);
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
        $this->crud->addField([
            'name'  => 'job_description',
            'type'  => 'wysiwyg',
            'label' => 'Job Description'
        ]);
    }

    public function store()
    {
        $response = $this->traitStore();
        $request = $response->getRequest();
        $job = $this->data['entry'];

        if($request->has('company_id') && $request->input('company_id') !== null) {

            $company = Company::find($request->input('company_id'));

            $title = 'New job posting for ' . $company->name;
            $description = $company->getShowLink() . ' is hiring for a ' . $job->employment_type . ' position: ' . $job->getShowLink();

            SendNotification::dispatch($company, $title, $description, 'jobs');
        }

        if($request->has('focus') && $request->input('focus') !== null) {
            foreach($request->input('focus') as $focusId) {

                $focus = Focus::find($focusId);

                $title = 'New job posting related to ' . $focus->name;
                $description = $company->getShowLink() . ' is hiring for a ' . $job->employment_type . ' position: ' . $job->getShowLink();

                SendNotification::dispatch($focus, $title, $description, 'jobs');
            }
        }

        return $response;
    }

    public function update()
    {
        $originalJob = $this->getOriginalModel($this->crud);
        $oldFocus = $this->getFocusIds($originalJob);

        $response = $this->traitUpdate();
        $request = $response->getRequest();

        $job = $this->data['entry'];
        $company = Company::find($job->company_id);

        $title = 'Updated job posting for ' . $company->name;
        $description = 'The job posting for ' . $job->getShowLink() . ' at ' . $company->getShowLink() . ' has been updated.';

        SendNotification::dispatch($company, $title, $description, 'jobs');

        $newFocus = $this->getFocusIds($job);

        $addedFocus = array_diff($newFocus, $oldFocus);
        $removedFocus = array_diff($oldFocus, $newFocus);

        // Waiting til later to implement
        // if($addedFocus !== [])
        // {
        //     foreach($addedFocus as $key => $focusId)
        //     {
        //         $title = 'Focus was added to job';

        //         $focus = Focus::find($focusId);
        //         SendNotification::dispatch($focus, $title, 'some long description', 'jobs');
        //     }
        // }

        // Waiting til later to implement
        // if($removedFocus !== [])
        // {
        //     foreach($removedFocus as $key => $focusId)
        //     {
        //         $title = 'Focus was removed from job';

        //         $focus = Focus::find($focusId);
        //         SendNotification::dispatch($focus, $title, 'some long description', 'jobs');
        //     }
        // }

        return $response;
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

    private function getFocusIds($model)
    {
        return $model->focus()->pluck('focus_id')->toArray();
    }

    private function getOriginalModel($crud)
    {
        $request = $crud->validateRequest();

        return Job::find($request->get($crud->model->getKeyName()));
    }
}
