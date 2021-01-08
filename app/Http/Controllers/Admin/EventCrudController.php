<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

/**
 * Class EventCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EventCrudController extends CrudController
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
        if(!backpack_user()->can('edit events')) {
            abort(404);
        }

        CRUD::setModel(Event::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/event');
        CRUD::setEntityNameStrings('event', 'events');
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
            'name' => 'name',
            'type' => 'text',
            'label' => 'Event Name']
        );
        $this->crud->addColumn([
            'name' => 'start_date',
            'type' => 'text',
            'label' => 'Start Date']
        );
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
           'label'     => 'Locations',
           'type'      => 'select_multiple',
           'name'      => 'locations',
           'entity'    => 'locations',
           'attribute' => 'name',
           'model'     => 'App\Models\Location',
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
        $this->crud->addColumn([
           'label'     => 'Exhibitors',
           'type'      => 'select_multiple',
           'name'      => 'companies',
           'entity'    => 'companies',
           'attribute' => 'name',
           'model'     => 'App\Models\Company',
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
        $this->crud->addColumn([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Event Name']
        );
        $this->crud->addColumn([
            'name' => 'start_date',
            'type' => 'date',
            'label' => 'Start Date']
        );
        $this->crud->addColumn([
            'name' => 'end_date',
            'type' => 'date',
            'label' => 'End Date']
        );
        $this->crud->addColumn([
            'name' => 'event_url',
            'type' => 'text',
            'label' => 'Event URL']
        );
        $this->crud->addColumn([
            'name' => 'registration_url',
            'type' => 'text',
            'label' => 'Registration URL']
        );
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
           'label'     => 'Locations',
           'type'      => 'select_multiple',
           'name'      => 'locations',
           'entity'    => 'locations',
           'attribute' => 'name',
           'model'     => 'App\Models\Location',
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
        $this->crud->addColumn([
           'label'     => 'Exhibitors',
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
           'label'     => 'Event Type',
           'type'      => 'select_multiple',
           'name'      => 'eventTypes',
           'entity'    => 'eventTypes',
           'attribute' => 'name',
           'model'     => 'App\Models\EventType',
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        $this->crud->addColumn([
            'name' => 'description',
            'type' => 'text',
            'label' => 'Description']
        );
        $this->crud->addColumn([
            'label'        => "Image",
            'name'         => "image",
            'type'         => 'image',
            'prefix'       => Event::getImageUrlPrefix(),
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
        CRUD::setValidation(EventRequest::class);

        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.updateSlug'
        ])->to('before_content');

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Event Name'
        ]);
        $this->crud->addField([
            'name' => 'slug',
            'type' => 'text',
            'label' => 'Page Slug'
        ]);
        $this->crud->addField([
            'name' => 'start_date',
            'type' => 'date_picker',
            'label' => 'Start Date',
            'date_picker_options' => [
                'format' => config('app.date_input_format'),
            ],
        ]);
        $this->crud->addField([
            'name' => 'end_date',
            'type' => 'date_picker',
            'label' => 'End Date',
            'date_picker_options' => [
                'format' => config('app.date_input_format'),
            ],
        ]);
        $this->crud->addField([
            'name' => 'event_url',
            'type' => 'url',
            'label' => 'Event URL'
        ]);
        $this->crud->addField([
            'name' => 'registration_url',
            'type' => 'url',
            'label' => 'Registration URL'
        ]);
        $this->crud->addField([
            'name' => 'description',
            'type' => 'wysiwyg',
            'label' => 'Event Description'
        ]);
        $this->crud->addField([
             'label'     => "Event Type(s)",
             'type'      => 'select2_multiple',
             'name'      => 'eventTypes',
             'entity'    => 'eventTypes',
             'attribute' => 'name',
             'pivot'     => true,
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
             'model'     => "App\Models\EventType",
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
        $this->crud->addField([
             'label'     => "Exhibitors",
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
            'label'        => "Image",
            'name'         => "image",
            'type'         => 'image',
            'upload'       => true,
            'crop'         => true,
            'aspect_ratio' => 0,
            'prefix'       => Event::getImageUrlPrefix(),
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
