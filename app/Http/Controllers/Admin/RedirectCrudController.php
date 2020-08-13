<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RedirectRecordRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class RedirectCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RedirectCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
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
        if(!backpack_user()->can('manage redirects')) {
            abort(404);
        }

        CRUD::setModel(\App\Models\Redirect::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/redirect');
        CRUD::setEntityNameStrings('redirect', 'redirects');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('old_slug');
        CRUD::column('redirectable_id');
        CRUD::column('redirectable_type');
        CRUD::column('created_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    protected function setupShowOperation()
    {
        $request = \Request::getPathInfo();
        $request_array = explode('/', $request);
        $this_redirect_id = $request_array[3];
        $redirect = \App\Models\Redirect::find($this_redirect_id);
        CRUD::field('old_slug');
            $this->crud->addColumn([
                'name'         => 'redirectable', // name of relationship method in the model
                'type'         => 'relationship',
                'label'        => 'Redirectable (' .$redirect->redirectable->getMorphClass().')' , // Table column heading
                // OPTIONAL
                 'entity'    => 'redirectable', // the method that defines the relationship in your Model
                 'attribute' => 'name', // foreign key attribute that is shown to user
                 'model'     => Relation::getMorphedModel($redirect->redirectable->getMorphClass()), // foreign key model
            ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(RedirectRecordRequest::class);

        CRUD::field('old_slug');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }
}
