<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendNotification;
use App\Helpers\NotificationHelper;
use App\Http\Controllers\Backpack\CRUD\Operations\UpdateOperationWithTouching;
use App\Http\Requests\ResearchRequest;
use App\Models\Focus;
use App\Models\Research;
use App\Notifications\ResearchCreated;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ResearchCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ResearchCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use UpdateOperationWithTouching { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        if(!backpack_user()->can('edit research')) {
            abort(404);
        }

        CRUD::setModel(Research::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/research');
        CRUD::setEntityNameStrings('research', 'research');
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
            'name'  => 'name',
            'label' => 'Name/Title',
            'type'  => 'text'
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
           'label'     => 'Companies',
           'type'      => 'select_multiple',
           'name'      => 'companies',
           'entity'    => 'companies',
           'attribute' => 'name',
           'model'     => 'App\Models\Company',
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        $this->crud->addColumn([
           'label'     => 'People',
           'type'      => 'select_multiple',
           'name'      => 'people',
           'entity'    => 'people',
           'attribute' => 'name',
           'model'     => 'App\Models\Person',
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
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
        $this->setupListOperation();

        $this->crud->addColumn([
            'name'  => 'link',
            'label' => 'Link',
            'type'  => 'text'
        ]);
        $this->crud->addColumn([
            'name'  => 'abstract',
            'label' => 'Abstract',
            'type'  => 'text'
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
        CRUD::setValidation(ResearchRequest::class);

        $this->crud->addField([
            'name'  => 'name',
            'label' => 'Name/Title',
            'type'  => 'text'
        ]);
        $this->crud->addField([
            'name'  => 'link',
            'label' => 'Link',
            'type'  => 'url'
        ]);
        $this->crud->addField([
            'name'  => 'abstract',
            'label' => 'Abstract',
            'type'  => 'textarea'
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
        $this->crud->addField([
             'label'     => "People",
             'type'      => 'select2_multiple',
             'name'      => 'people',
             'entity'    => 'people',
             'attribute' => 'name',
             'pivot'     => true,
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
             'model'     => "App\Models\Person",
        ]);
    }

    public function store()
    {
        $response = $this->traitStore();
        $request = $response->getRequest();
        $research = $this->data['entry'];

        if($request->has('focus') && $request->input('focus') !== null) {
            foreach($request->input('focus') as $focusId) {
                $focus = Focus::find($focusId);

                $title = 'New research related to ' . $focus->name;
                $description = $research->getShowLink() . ' has been added to ' . $focus->getShowLink() . '.';

                SendNotification::dispatch($focus, $title, $description, 'focus');
            }
        }

        NotificationHelper::sendSlackNotification(new ResearchCreated($research), 'research');

        return $response;
    }

    public function update()
    {
        $originalResearch = $this->getOriginalModel($this->crud);
        $oldFocus = $this->getFocusIds($originalResearch);
        $response = $this->traitUpdate();
        $research = $this->data['entry'];
        $newFocus = $this->getFocusIds($research);
        $addedFocus = array_diff($newFocus, $oldFocus);

        if($addedFocus !== [])
        {
            foreach($addedFocus as $key => $focusId)
            {
                $focus = Focus::find($focusId);

                $title = 'Research updated related to ' . $focus->name;
                $description = $research->getShowLink() . ' has been updated with a focus on ' . $focus->getShowLink() . '.';

                SendNotification::dispatch($focus, $title, $description, 'focus');
            }
        }

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

        return Research::find($request->get($crud->model->getKeyName()));
    }
}
