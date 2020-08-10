<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EventRequest;
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

        CRUD::setModel(\App\Models\Event::class);
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
        // CRUD::setFromDb(); // columns

        // Event Name
        $this->crud->addColumn([
            'name' => 'name', 
            'type' => 'text', 
            'label' => 'Event Name']
        );

        // Start Date
        $this->crud->addColumn([
            'name' => 'start_date', 
            'type' => 'text', 
            'label' => 'Start Date']
        );

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
           'label'     => 'Locations',
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

        // People -- Relationship
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

        // Company -- Relationship
        $this->crud->addColumn([
           'label'     => 'Exhibitors',
           'type'      => 'select_multiple',
           'name'      => 'companies',
           'entity'    => 'companies',
           'attribute' => 'name',
           'model'     => 'App\Models\Company',
           // 'orderable' => true,
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Show operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupShowOperation()
    {
        // $this->setupListOperation();

        // Event Name
        $this->crud->addColumn([
            'name' => 'name', 
            'type' => 'text', 
            'label' => 'Event Name']
        );

        // Start Date
        $this->crud->addColumn([
            'name' => 'start_date', 
            'type' => 'date', 
            'label' => 'Start Date']
        );

        // End Date
        $this->crud->addColumn([
            'name' => 'end_date', 
            'type' => 'date', 
            'label' => 'End Date']
        );

        // Event URL
        $this->crud->addColumn([
            'name' => 'event_url', 
            'type' => 'text', 
            'label' => 'Event URL']
        );

        // Registration URL
        $this->crud->addColumn([
            'name' => 'registration_url', 
            'type' => 'text', 
            'label' => 'Registration URL']
        );

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
           'label'     => 'Locations',
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

        // People -- Relationship
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

        // Company -- Relationship
        $this->crud->addColumn([
           'label'     => 'Exhibitors',
           'type'      => 'select_multiple',
           'name'      => 'companies',
           'entity'    => 'companies',
           'attribute' => 'name',
           'model'     => 'App\Models\Company',
           // 'orderable' => true,
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        // Event Type -- Relationship
        $this->crud->addColumn([
           'label'     => 'Event Type',
           'type'      => 'select_multiple',
           'name'      => 'eventTypes',
           'entity'    => 'eventTypes',
           'attribute' => 'name',
           'model'     => 'App\Models\EventType',
           // 'orderable' => true,
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        // Description
        $this->crud->addColumn([
            'name' => 'description', 
            'type' => 'text', 
            'label' => 'Description']
        );

        // Image
        $this->crud->addColumn([
            'label'        => "Image",
            'name'         => "image",
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
        CRUD::setValidation(EventRequest::class);

        // CRUD::setFromDb(); // fields

        // Update Slug Widget
        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.updateSlug'
        ])->to('before_content');

        // Event Name
        $this->crud->addField([
            'name' => 'name', 
            'type' => 'text', 
            'label' => 'Event Name'
        ]);

        // Page Slug
        $this->crud->addField([
            'name' => 'slug', 
            'type' => 'text', 
            'label' => 'Page Slug'
        ]);

        // Start Date
        $this->crud->addField([
            'name' => 'start_date', 
            'type' => 'date', 
            'label' => 'Start Date'
        ]);

        // End Date
        $this->crud->addField([
            'name' => 'end_date', 
            'type' => 'date', 
            'label' => 'End Date'
        ]);

        // Event URL
        $this->crud->addField([
            'name' => 'event_url', 
            'type' => 'url', 
            'label' => 'Event URL'
        ]);

        // Registration URL
        $this->crud->addField([
            'name' => 'registration_url', 
            'type' => 'url', 
            'label' => 'Registration URL'
        ]);

        // Event Description
        $this->crud->addField([
            'name' => 'description', 
            'type' => 'wysiwyg', 
            'label' => 'Event Description'
        ]);

        // Event Type Relationship
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

        // Focus Relationship
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

        // People Relationship
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

        // Company Relationship
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

        // Image
        $this->crud->addField([
            'label'        => "Image",
            'name'         => "image",
            'type'         => 'image',
            'upload'       => true,
            'crop'         => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 0, // ommit or set to 0 to allow any aspect ratio
            'disk'      => 'local', // in case you need to show images from a different disk
            // 'prefix'    => 'storage/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
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