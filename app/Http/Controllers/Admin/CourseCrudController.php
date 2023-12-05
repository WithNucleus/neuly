<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\DataFeed;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CourseCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CourseCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Course::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/course');
        CRUD::setEntityNameStrings('course', 'courses');
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
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text',
        ]);

        $this->crud->addColumn([
            'name' => 'url',
            'label' => 'URL',
            'type' => 'text',
        ]);

        $this->crud->addColumn([
            'name' => 'focus',
            'label' => 'Focus',
            'type' => 'relationship',
        ]);

        $this->crud->addColumn([
            'name' => 'companies',
            'label' => 'Organization',
            'type' => 'relationship',
        ]);

        $this->crud->addColumn([
            'name' => 'image',
            'label' => 'Image',
            'type' => 'image',
            'prefix' => Course::getImageUrlPrefix(),
        ]);

        $this->crud->addColumn([
            'name' => 'created_at',
            'label' => 'Created',
            'type' => 'date',
        ]);

        $this->crud->addColumn([
            'name' => 'updated_at',
            'label' => 'Updated',
            'type' => 'date',
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();

        CRUD::setFromDb(); // columns
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     *
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CourseRequest::class);

        $this->crud->addField([
            'label' => 'Focus',
            'type' => 'select2_multiple',
            'name' => 'focus',
            'entity' => 'focus',
            'attribute' => 'name',
            'pivot' => true,
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'model' => \App\Models\Focus::class,
        ]);

        $this->crud->addField([
            'label' => 'Organization',
            'type' => 'select2_multiple',
            'name' => 'companies',
            'entity' => 'companies',
            'attribute' => 'name',
            'pivot' => true,
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'model' => \App\Models\Company::class,
        ]);

        $this->crud->addField([
            'label' => 'Program',
            'type' => 'select2_multiple',
            'name' => 'programs',
            'entity' => 'programs',
            'attribute' => 'name',
            'pivot' => true,
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'model' => \App\Models\CourseProgram::class,
        ]);

        $this->crud->addField([
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text',
        ]);

        $this->crud->addField([
            'name' => 'url',
            'label' => 'URL',
            'type' => 'text',
        ]);

        $this->crud->addField([
            'name' => 'type',
            'label' => 'Type',
            'type' => 'select2_from_array',
            'options' => Course::getTypes(),
            'allows_null' => false,
        ]);

        $this->crud->addField([
            'name' => 'summary',
            'label' => 'Summary',
            'type' => 'textarea',
        ]);

        $this->crud->addField([
            'name' => 'lowest_cost',
            'label' => 'Lowest Cost',
            'type' => 'number',
        ]);

        $this->crud->addField([
            'name' => 'highest_cost',
            'label' => 'Highest Cost',
            'type' => 'number',
        ]);

        $this->crud->addField([
            'name' => 'currency',
            'label' => 'Currency',
            'type' => 'text',
        ]);

        $this->crud->addField([
            'name' => 'education_credits',
            'label' => 'Education Credits',
            'type' => 'text',
        ]);

        $this->crud->addField([
            'name' => 'learning_location',
            'label' => 'Learning Location',
            'type' => 'text',
        ]);

        $this->crud->addField([
            'name' => 'delivery_method',
            'label' => 'Delivery Method',
            'type' => 'text',
        ]);

        $this->crud->addField([
            'name' => 'program',
            'label' => 'Program',
            'type' => 'text',
        ]);

        $this->crud->addField([
            'name' => 'hours',
            'label' => 'Hours',
            'type' => 'number',
        ]);

        $this->crud->addField([
            'name' => 'length',
            'label' => 'Length',
            'type' => 'text',
        ]);

        $this->crud->addField([
            'name' => 'next_date',
            'label' => 'Next Date (optional)',
            'type' => 'date',
        ]);

        $this->crud->addField([
            'name' => 'finish_date',
            'label' => 'Finish Date (optional)',
            'type' => 'date',
        ]);

        $this->crud->addField([
            'name' => 'awarded',
            'label' => 'Awarded',
            'type' => 'text',
        ]);

        $this->crud->addField([
            'name' => 'concierge',
            'label' => 'Concierge',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'referral_link',
            'label' => 'Referral Link',
            'type' => 'url',
        ]);

        $this->crud->addField([
            'label' => 'Image',
            'name' => 'image',
            'type' => 'image',
            'upload' => true,
            'crop' => true,
            'aspect_ratio' => 0,
            'prefix' => Course::getImageUrlPrefix(),
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
     *
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
