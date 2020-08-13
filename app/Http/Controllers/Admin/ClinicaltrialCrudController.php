<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ClinicaltrialRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ClinicaltrialCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ClinicaltrialCrudController extends CrudController
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
        if(!backpack_user()->can('edit clinical trials')) {
            abort(404);
        }

        CRUD::setModel(\App\Models\Clinicaltrial::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/clinicaltrial');
        CRUD::setEntityNameStrings('Clinical trial', 'Clinical trials');

        // List
        $this->crud->operation('list', function() {

            $this->crud->addColumn(['name' => 'nct_number', 'type' => 'text', 'label' => 'NCT Number']);
            $this->crud->addColumn(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
            $this->crud->addColumn(['name' => 'status', 'type' => 'text', 'label' => 'Status']);

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
            // $this->crud->addColumn([
            //    'label'     => 'Location',
            //    'type'      => 'select_multiple',
            //    'name'      => 'locations',
            //    'entity'    => 'locations',
            //    'attribute' => 'name',
            //    'model'     => 'App\Models\Location',
            //    // 'orderable' => true,
            //    'options'   => (function ($query) {
            //         return $query->orderBy('name', 'ASC')->get();
            //     }),
            // ]);

            // People -- Relationship
            // $this->crud->addColumn([
            //    'label'     => 'People',
            //    'type'      => 'select_multiple',
            //    'name'      => 'people',
            //    'entity'    => 'people',
            //    'attribute' => 'name',
            //    'model'     => 'App\Models\Person',
            //    // 'orderable' => true,
            //    'options'   => (function ($query) {
            //         return $query->orderBy('name', 'ASC')->get();
            //     }),
            // ]);

            // Company -- Relationship
            $this->crud->addColumn([
               'label'     => 'Collaborators',
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

        });
    }

    /**
     * Define what happens when the Show operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupShowOperation()
    {

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

        // Company -- Relationship
        $this->crud->addColumn([
           'label'     => 'Collaborators',
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

        CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ClinicaltrialRequest::class);

        //CRUD::setFromDb(); // fields

        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        // $this->crud->addField(['name' => 'slug', 'type' => 'text', 'label' => 'Page Slug']);
        $this->crud->addField(['name' => 'nct_number', 'type' => 'text', 'label' => 'NCT Number']);

        $this->crud->addField(['name' => 'acronym', 'type' => 'text', 'label' => 'Acronym']);
        $this->crud->addField(['name' => 'status', 'type' => 'text', 'label' => 'Status']);
        $this->crud->addField(['name' => 'study_results', 'type' => 'text', 'label' => 'Study results']);
        $this->crud->addField(['name' => 'conditions', 'type' => 'text', 'label' => 'Conditions']);
        $this->crud->addField(['name' => 'interventions', 'type' => 'text', 'label' => 'Interventions']);
        $this->crud->addField(['name' => 'outcome_measures', 'type' => 'textarea', 'label' => 'Outcome measures']);
        $this->crud->addField(['name' => 'gender', 'type' => 'text', 'label' => 'Gender']);
        $this->crud->addField(['name' => 'age', 'type' => 'text', 'label' => 'Age']);
        $this->crud->addField(['name' => 'phases', 'type' => 'text', 'label' => 'Phases']);
        $this->crud->addField(['name' => 'enrollment', 'type' => 'text', 'label' => 'Enrollment']);
        $this->crud->addField(['name' => 'funded_bys', 'type' => 'text', 'label' => 'Funded bys']);
        $this->crud->addField(['name' => 'study_type', 'type' => 'text', 'label' => 'Study type']);
        $this->crud->addField(['name' => 'study_designs', 'type' => 'textarea', 'label' => 'Study designs']);
        $this->crud->addField(['name' => 'other_ids', 'type' => 'text', 'label' => 'Ohter IDs']);
        $this->crud->addField(['name' => 'start_date', 'type' => 'date', 'label' => 'Start date']);
        $this->crud->addField(['name' => 'primary_completion_date', 'type' => 'date', 'label' => 'Primary completion date']);
        $this->crud->addField(['name' => 'completion_date', 'type' => 'date', 'label' => 'Completion date']);
        $this->crud->addField(['name' => 'first_posted', 'type' => 'date', 'label' => 'First posted']);
        $this->crud->addField(['name' => 'results_first_posted', 'type' => 'date', 'label' => 'Results first posted']);
        $this->crud->addField(['name' => 'last_update_posted', 'type' => 'date', 'label' => 'Last update posted']);

        // Location -- Relationship
        $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
             'label'     => "Locations",
             'type'      => 'select2_multiple',
             'name'      => 'locations', // the method that defines the relationship in your Model
             'entity'    => 'locations', // the method that defines the relationship in your Model
             'attribute' => 'name', // foreign key attribute that is shown to user

             'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
             // 'select_all' => true, // show Select All and Clear buttons?
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),

             // optional
             'model'     => "App\Models\Location", // foreign key model
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
             'label'     => "Organizations",
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
