<?php

namespace App\Http\Controllers\Admin;

use App\Models\SearchLog;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SearchLogCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SearchLogCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        if (! backpack_user()->can('view logs')) {
            abort(404);
        }

        CRUD::setModel(SearchLog::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/searchlog');
        CRUD::setEntityNameStrings('search log', 'search log');
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
        CRUD::setFromDb();

        $this->crud->addColumn([
            'type' => 'datetime',
            'name' => 'created_at',
            'label' => 'Created on',
        ]);
    }
}
