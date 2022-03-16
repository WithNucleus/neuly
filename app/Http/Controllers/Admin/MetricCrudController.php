<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MetricRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MetricCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MetricCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Metric::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/metric');
        CRUD::setEntityNameStrings('metric', 'metrics');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('date')->type('date');
        CRUD::column('type');
        CRUD::column('notes');
        CRUD::column('organizations');
        CRUD::column('people');
        CRUD::column('investors');
        CRUD::column('events_total');
        CRUD::column('events_upcoming');
        CRUD::column('events_past');
        CRUD::column('jobs_total');
        CRUD::column('jobs_open');
        CRUD::column('jobs_archived');
        CRUD::column('media_items_total');
        CRUD::column('news');
        CRUD::column('articles');
        CRUD::column('images');
        CRUD::column('videos');
        CRUD::column('mixed_media');
        CRUD::column('podcasts');
        CRUD::column('books');
        CRUD::column('patent_filings');
        CRUD::column('courses');
        CRUD::column('patents');

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
        CRUD::setValidation(MetricRequest::class);

//        CRUD::field('date');
//        CRUD::field('type');
//        CRUD::field('notes');
//        CRUD::field('organizations');
//        CRUD::field('people');
//        CRUD::field('investors');
//        CRUD::field('events_total');
//        CRUD::field('events_upcoming');
//        CRUD::field('events_past');
//        CRUD::field('jobs_total');
//        CRUD::field('jobs_open');
//        CRUD::field('jobs_archived');
//        CRUD::field('media_items_total');
//        CRUD::field('news');
//        CRUD::field('articles');
//        CRUD::field('images');
//        CRUD::field('videos');
//        CRUD::field('mixed_media');
//        CRUD::field('podcasts');
//        CRUD::field('books');
//        CRUD::field('patent_filings');
//        CRUD::field('courses');
//        CRUD::field('patents');
//        CRUD::field('created_at');
//        CRUD::field('updated_at');

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
