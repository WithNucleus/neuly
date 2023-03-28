<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MetricCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MetricCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
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
        CRUD::setRoute(config('backpack.base.route_prefix').'/metric');
        CRUD::setEntityNameStrings('metric', 'metrics');
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
        CRUD::column('date')->type('date');
        CRUD::column('type');
        CRUD::column('notes');
        CRUD::column('organizations');
        CRUD::column('people');
        CRUD::column('investors');
        CRUD::column('clinical_trials');
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
        CRUD::column('bookable_listings');
    }
}
