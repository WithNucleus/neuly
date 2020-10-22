<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RedirectRecordRequest;
use App\Models\Redirect;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

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
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation { show as traitShow; }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        if(!backpack_user()->can('manage redirects')) {
            abort(404);
        }

        CRUD::setModel(Redirect::class);
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
    }

    public function show($id)
    {
        $redirect = Redirect::findOrFail($id);

        $this->crud->addColumn([
            'name'      => 'redirectable',
            'type'      => 'relationship',
            'label'     => 'Redirectable (' . $redirect->redirectable->getMorphClass() . ')',
            'entity'    => 'redirectable',
            'attribute' => 'name',
            'model'     => $redirect->redirectable->getMorphClass(),
        ]);

        $content = $this->traitShow($id);

        return $content;
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
    }
}
