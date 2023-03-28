<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ClinicaltrialRequest;
use App\Models\Clinicaltrial;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ClinicaltrialCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        if (! backpack_user()->can('edit clinical trials')) {
            abort(404);
        }

        CRUD::setModel(Clinicaltrial::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/clinicaltrial');
        CRUD::setEntityNameStrings('Clinical trial', 'Clinical trials');
    }

    public function setupListOperation() {
        $this->crud->addColumn(['name' => 'nct_number', 'type' => 'text', 'label' => 'NCT Number']);
        $this->crud->addColumn(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addColumn(['name' => 'status', 'type' => 'text', 'label' => 'Status']);

        $this->crud->addColumn([
            'label' => 'Focus',
            'type' => 'relationship',
            'name' => 'focus',
            'attribute' => 'name',
        ]);

        $this->crud->addColumn([
            'label' => 'Collaborators',
            'type' => 'relationship',
            'name' => 'companies',
            'attribute' => 'name',
        ]);
    }

    /**
     * Define what happens when the Show operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     *
     * @return void
     */
    protected function setupShowOperation()
    {
        $this->setupListOperation();

        $this->crud->addColumn([
            'label' => 'Location',
            'type' => 'relationship',
            'name' => 'locations',
            'attribute' => 'name',
        ]);

        $this->crud->addColumn([
            'label' => 'People',
            'type' => 'relationship',
            'name' => 'people',
            'attribute' => 'name',
        ]);

        $this->crud->addColumn([
            'type' => 'relationship',
            'name' => 'conditions',
            'attribute' => 'value',
            'options' => (function ($query) {
                return $query->orderBy('value', 'ASC')->get();
            }),
        ]);

        $this->crud->addColumn([
            'type' => 'relationship',
            'name' => 'interventions',
            'attribute' => 'value',
            'options' => (function ($query) {
                return $query->orderBy('value', 'ASC')->get();
            }),
        ]);

        $this->crud->addColumn([
            'type' => 'relationship',
            'name' => 'outcomeMeasures',
            'label' => 'Outcome Measures',
            'attribute' => 'value',
            'options' => (function ($query) {
                return $query->orderBy('value', 'ASC')->get();
            }),
        ]);

        $this->crud->addColumn([
            'type' => 'relationship',
            'name' => 'studyDesigns',
            'label' => 'Study Designs',
            'attribute' => 'value',
            'options' => (function ($query) {
                return $query->orderBy('value', 'ASC')->get();
            }),
        ]);

        CRUD::setFromDb();

        $this->crud->addButtonFromModelFunction('line', 'show_entity', 'getShowEntityPageButton', 'beginning');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(ClinicaltrialRequest::class);

        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addField(['name' => 'nct_number', 'type' => 'text', 'label' => 'NCT Number']);

        $this->crud->addField(['name' => 'acronym', 'type' => 'text', 'label' => 'Acronym']);
        $this->crud->addField(['name' => 'status', 'type' => 'text', 'label' => 'Status']);
        $this->crud->addField(['name' => 'study_results', 'type' => 'text', 'label' => 'Study results']);
        $this->crud->addField(['name' => 'gender', 'type' => 'text', 'label' => 'Gender']);
        $this->crud->addField(['name' => 'age', 'type' => 'text', 'label' => 'Age']);
        $this->crud->addField(['name' => 'phases', 'type' => 'text', 'label' => 'Phases']);
        $this->crud->addField(['name' => 'enrollment', 'type' => 'text', 'label' => 'Enrollment']);
        $this->crud->addField(['name' => 'funded_bys', 'type' => 'text', 'label' => 'Funded bys']);
        $this->crud->addField(['name' => 'study_type', 'type' => 'text', 'label' => 'Study type']);
        $this->crud->addField(['name' => 'other_ids', 'type' => 'text', 'label' => 'Ohter IDs']);
        $this->crud->addField([
            'name' => 'start_date',
            'type' => 'date_picker',
            'label' => 'Start date',
            'date_picker_options' => [
                'format' => config('app.datepicker_input_format'),
            ],
        ]);
        $this->crud->addField([
            'name' => 'primary_completion_date',
            'type' => 'date_picker',
            'label' => 'Primary completion date',
            'date_picker_options' => [
                'format' => config('app.datepicker_input_format'),
            ],
        ]);
        $this->crud->addField([
            'name' => 'completion_date',
            'type' => 'date_picker',
            'label' => 'Completion date',
            'date_picker_options' => [
                'format' => config('app.datepicker_input_format'),
            ],
        ]);
        $this->crud->addField([
            'name' => 'first_posted',
            'type' => 'date_picker',
            'label' => 'First posted',
            'date_picker_options' => [
                'format' => config('app.datepicker_input_format'),
            ],
        ]);
        $this->crud->addField([
            'name' => 'results_first_posted',
            'type' => 'date_picker',
            'label' => 'Results first posted',
            'date_picker_options' => [
                'format' => config('app.datepicker_input_format'),
            ],
        ]);
        $this->crud->addField([
            'name' => 'last_update_posted',
            'type' => 'date_picker',
            'label' => 'Last update posted',
            'date_picker_options' => [
                'format' => config('app.datepicker_input_format'),
            ],
        ]);

        $this->crud->addField([
            'label' => 'Locations',
            'type' => 'relationship',
            'name' => 'locations',
            'attribute' => 'name',
        ]);

        $this->crud->addField([
            'label' => 'People',
            'type' => 'relationship',
            'name' => 'people',
            'attribute' => 'name',
        ]);

        $this->crud->addField([
            'label' => 'Collaborators',
            'type' => 'relationship',
            'name' => 'companies',
            'attribute' => 'name',
        ]);

        $this->crud->addField([
            'label' => 'Focus',
            'type' => 'relationship',
            'name' => 'focus',
            'attribute' => 'name',
        ]);

        $this->crud->addField([
            'type' => 'relationship',
            'name' => 'conditions',
            'label' => 'Conditions',
            'attribute' => 'value',
        ]);

        $this->crud->addField([
            'type' => 'relationship',
            'name' => 'interventions',
            'label' => 'Interventions',
            'attribute' => 'value',
        ]);

        $this->crud->addField([
            'type' => 'relationship',
            'name' => 'outcomeMeasures',
            'label' => 'Outcome Measures',
            'attribute' => 'value',
        ]);

        $this->crud->addField([
            'type' => 'relationship',
            'name' => 'studyDesigns',
            'label' => 'Study Designs',
            'attribute' => 'value',
        ]);
    }
    
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
