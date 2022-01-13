<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CourseCrudController
 * @package App\Http\Controllers\Admin
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
        CRUD::setRoute(config('backpack.base.route_prefix') . '/course');
        CRUD::setEntityNameStrings('course', 'courses');
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
            'name'    => 'name',
            'label'   => 'Name',
            'type'    => 'text',
        ]);

        $this->crud->addColumn([
            'name'    => 'schedule',
            'label'   => 'Schedule',
            'type'    => 'text',
        ]);

        $this->crud->addColumn([
            'name'    => 'url',
            'label'   => 'URL',
            'type'    => 'text',
        ]);

        $this->crud->addColumn([
            'name'    => 'focus',
            'label'   => 'Focus',
            'type'    => 'relationship',
        ]);

        $this->crud->addColumn([
            'name'    => 'companies',
            'label'   => 'Organization',
            'type'    => 'relationship',
        ]);

        $this->crud->addColumn([
            'name'    => 'created_at',
            'label'   => 'Created',
            'type'    => 'date',
        ]);

        $this->crud->addColumn([
            'name'    => 'updated_at',
            'label'   => 'Updated',
            'type'    => 'date',
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
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CourseRequest::class);

        $this->crud->addField([
            'label'     => "Focus",
            'type'      => 'select2_multiple',
            'name'      => 'focus',
            'entity'    => 'focus',
            'attribute' => 'name',
            'pivot'   => true,
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'model'   => "App\Models\Focus",
        ]);

        $this->crud->addField([
            'label'     => "Organization",
            'type'      => 'select2_multiple',
            'name'      => 'companies',
            'entity'    => 'companies',
            'attribute' => 'name',
            'pivot'   => true,
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'model'   => "App\Models\Company",
        ]);

        $this->crud->addField([
            'name'    => 'name',
            'label'   => 'Name',
            'type'    => 'text',
        ]);

        $this->crud->addField([
            'name'    => 'url',
            'label'   => 'URL',
            'type'    => 'text',
        ]);

        $this->crud->addField([
            'name'    => 'type',
            'label'   => 'Type',
            'type'        => 'select2_from_array',
            'options'     => Course::getTypes(),
            'allows_null' => false,
        ]);

        $this->crud->addField([
            'name'    => 'summary',
            'label'   => 'Summary',
            'type'    => 'textarea',
        ]);

        $this->crud->addField([
            'name'    => 'schedule',
            'label'   => 'Schedule',
            'type'        => 'select2_from_array',
            'options'     => Course::getSchedules(),
            'allows_null' => true,
        ]);

        $this->crud->addField([
            'name'    => 'lowest_cost',
            'label'   => 'Lowest Cost',
            'type'    => 'number',
        ]);

        $this->crud->addField([
            'name'    => 'highest_cost',
            'label'   => 'Highest Cost',
            'type'    => 'number',
        ]);

        $this->crud->addField([
            'name'    => 'education_credits',
            'label'   => 'Education Credits',
            'type'    => 'text',
        ]);

        $this->crud->addField([
            'name'    => 'next_date',
            'label'   => 'Next Date (optional)',
            'type'    => 'date',
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
