<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DataFeedRequest;
use App\Jobs\DataFeeds\GetRssFeed;
use App\Models\DataFeed;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Support\Facades\Route;
use Prologue\Alerts\Facades\Alert;

/**
 * Class DataFeedCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DataFeedCrudController extends CrudController
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
        CRUD::setModel(\App\Models\DataFeed::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/datafeed');
        CRUD::setEntityNameStrings('data feed', 'data feeds');
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
            'label' => 'Title',
            'type' => 'text',
        ]);

        $this->crud->addColumn([
            'name' => 'url',
            'label' => 'URL',
            'type' => 'text',
        ]);

        $this->crud->addColumn([
            'name' => 'source_category',
            'label' => 'Source Category',
            'type' => 'text',
        ]);

        $this->crud->addColumn([
            'name' => 'auto_approval',
            'label' => 'Auto Approval',
            'type' => 'boolean',
        ]);

        $this->crud->addColumn([
            'name' => 'status',
            'label' => 'Status',
            'type' => 'text',
        ]);

        $this->crud->addColumn([
            'name' => 'media_type',
            'label' => 'Media Type',
            'type' => 'text',
        ]);

        $this->crud->query->withCount('mediaItems');
        $this->crud->addColumn([
            'name' => 'media_items_count', // name of relationship method in the model
            'type' => 'text',
            'label' => 'Media Items', // Table column heading
        ]);

        $this->crud->addButtonFromView('line', 'datafeed.get-feed', 'datafeed.get-feed', 'beginning');

        $this->crud->addFilter([
            'name' => 'media_type',
            'type' => 'select2_multiple',
            'label' => 'Media Type',
        ], function () {
            return DataFeed::getMediaTypes();
        }, function ($values) {
            $this->crud->addClause('whereIn', 'media_type', json_decode($values));
        });

        $this->crud->addFilter([
            'name' => 'source_category',
            'type' => 'select2_multiple',
            'label' => 'Source Category',
        ], function () {
            return DataFeed::getSourceCategories();
        }, function ($values) {
            $this->crud->addClause('whereIn', 'source_category', json_decode($values));
        });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'active',
            'label' => 'Active',
        ], false, function () {
            $this->crud->addClause('active');
        });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'auto_approval',
            'label' => 'Auto Approval',
        ], false, function () {
            $this->crud->addClause('autoApproval');
        });
    }

    protected function setupShowOperation()
    {
        $id = Route::current()->parameter('id');
        $dataFeed = DataFeed::with('mediaItems')->find($id);

        $this->setupListOperation();

        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.datafeed.media-items-list',
            'dataFeed' => $dataFeed,
        ])->to('after_content');
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
        CRUD::setValidation(DataFeedRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'label' => 'Title',
            'type' => 'text',
        ]);

        $this->crud->addField([
            'name' => 'url',
            'label' => 'URL',
            'type' => 'text',
        ]);

        $this->crud->addField([
            'name' => 'feed_type',
            'type' => 'select2_from_array',
            'label' => 'Feed Type',
            'options' => DataFeed::getFeedTypes(),
            'allows_null' => false,
        ]);

        $this->crud->addField([
            'name' => 'media_type',
            'type' => 'select2_from_array',
            'label' => 'Media Type',
            'options' => DataFeed::getMediaTypes(),
            'allows_null' => false,
        ]);

        $this->crud->addField([
            'name' => 'source_category',
            'type' => 'select2_from_array',
            'label' => 'Source Category',
            'options' => DataFeed::getSourceCategories(),
            'allows_null' => false,
        ]);

        $this->crud->addField([
            'name' => 'status',
            'type' => 'select2_from_array',
            'label' => 'Status',
            'options' => DataFeed::getStatuses(),
            'allows_null' => false,
        ]);

        $this->crud->addField([
            'name' => 'summary',
            'label' => 'Summary',
            'type' => 'textarea',
        ]);

        $this->crud->addField([
            'name' => 'auto_approval',
            'type' => 'boolean',
            'label' => 'Auto Approval',
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

    /**
     * Gets the items from a data feed and creates/updates media items
     */
    public function getFeedItems($id): \Illuminate\Http\RedirectResponse
    {
        $dataFeed = DataFeed::findOrFail($id);

        if ($dataFeed->feed_type == DataFeed::FEED_TYPE_RSS) {
            GetRssFeed::dispatch($dataFeed);
            Alert::add('success', 'Getting RSS feed...')->flash();
        }

        return redirect()->route('admin.datafeed.show', $id);
    }
}
