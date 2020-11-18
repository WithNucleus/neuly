<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendNotification;
use App\Http\Requests\JobRequest;
use App\Models\Company;
use App\Models\Focus;
use App\Models\Investor;
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
            'label'     => "Owner",
            'type'      => 'select',
            'name'      => 'owner_id',
            'entity'    => 'owner',
            'attribute' => 'name',
        ]);

        $this->crud->addColumn([
            'label'     => "Owner type",
            'name'      => 'owner_type',
            'type'      => 'text',
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
            'type'  => 'date_picker',
            'label' => 'Posted Date',
            'date_picker_options' => [
                'format' => config('app.date_input_format'),
            ],
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
            'name'  => 'owner',
            'type'  => 'select2_morph_1_n',
            'label' => 'Owner',
            'showAsterisk' => true,
            'data' => [
                'companies' => [
                    'label' => 'Company',
                    'type' => Company::class,
                    'options' => Company::orderBy('name')->pluck('name', 'id'),
                ],
                'investors' => [
                    'label' => 'Investor',
                    'type' => Investor::class,
                    'options' => Investor::orderBy('name')->pluck('name', 'id'),
                ],
            ]
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

    public function store()
    {
        //backpack documented hack to not strip custom fields for morph relations
        $this->crud->setOperationSetting('saveAllInputsExcept', ['_token', '_method', 'http_referrer', 'current_tab', 'save_action']);

        $response = $this->traitStore();
        $request = $response->getRequest();
        $job = $this->data['entry'];

        $owner       = $job->owner;
        $title       = 'New job posting for ' . $owner->name;
        $description = $owner->getShowLink() . ' is hiring for a ' . $job->employment_type . ' position: ' . $job->getShowLink();

        SendNotification::dispatch($owner, $title, $description, 'jobs');

        if($request->has('focus') && $request->input('focus') !== null) {
            foreach($request->input('focus') as $focusId) {

                $focus = Focus::find($focusId);

                $title = 'New job posting related to ' . $focus->name;
                $description = $owner->getShowLink() . ' is hiring for a ' . $job->employment_type . ' position: ' . $job->getShowLink();

                SendNotification::dispatch($focus, $title, $description, 'jobs');
            }
        }

        return $response;
    }

    public function update()
    {
        //backpack documented hack to not strip custom fields for morph relations
        $this->crud->setOperationSetting('saveAllInputsExcept', ['_token', '_method', 'http_referrer', 'current_tab', 'save_action']);

        $originalJob = $this->getOriginalModel($this->crud);
        $oldFocus = $this->getFocusIds($originalJob);

        $response = $this->traitUpdate();
        $request = $response->getRequest();

        $job = $this->data['entry'];

        $owner       = $job->owner;
        $title       = 'Updated job posting for ' . $owner->name;
        $description = 'The job posting for ' . $job->getShowLink() . ' at ' . $owner->getShowLink() . ' has been updated.';

        SendNotification::dispatch($owner, $title, $description, 'jobs');

        // Waiting till later to implement
//        $newFocus = $this->getFocusIds($job);

//        $addedFocus = array_diff($newFocus, $oldFocus);
//        $removedFocus = array_diff($oldFocus, $newFocus);

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
