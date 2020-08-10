<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ResearchRequest;
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
        if(!backpack_user()->can('edit research')) {
            abort(404);
        }

        CRUD::setModel(\App\Models\Research::class);
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
        // CRUD::setFromDb(); // columns

        // Name
        $this->crud->addColumn([
            'name'  => 'name',
            'label' => 'Name/Title',
            'type'  => 'text'
        ]);

        // Link
        // $this->crud->addColumn([
        //     'name'  => 'link',
        //     'label' => 'Link',
        //     'type'  => 'text'
        // ]);

        // Abstract
        // $this->crud->addColumn([
        //     'name'  => 'abstract',
        //     'label' => 'Abstract',
        //     'type'  => 'text'
        // ]);

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

        // Companies -- Relationship
        $this->crud->addColumn([
           'label'     => 'Companies',
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
        $this->setupListOperation();

        // Link
        $this->crud->addColumn([
            'name'  => 'link',
            'label' => 'Link',
            'type'  => 'text'
        ]);

        // Abstract
        $this->crud->addColumn([
            'name'  => 'abstract',
            'label' => 'Abstract',
            'type'  => 'text'
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
        CRUD::setValidation(ResearchRequest::class);

        // CRUD::setFromDb(); // fields

        // Name
        $this->crud->addField([
            'name'  => 'name',
            'label' => 'Name/Title',
            'type'  => 'text'
        ]);

        // Link
        $this->crud->addField([
            'name'  => 'link',
            'label' => 'Link',
            'type'  => 'url'
        ]);

        // Abstract
        $this->crud->addField([
            'name'  => 'abstract',
            'label' => 'Abstract',
            'type'  => 'textarea'
        ]);

        // Focus -- Relationship
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

             // optional
             'model'     => "App\Models\Focus", // foreign key model
        ]);

        // Companies -- Relationship
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

             // optional
             'model'     => "App\Models\Company", // foreign key model
        ]);

        // People -- Relationship
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

             // optional
             'model'     => "App\Models\Person", // foreign key model
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
