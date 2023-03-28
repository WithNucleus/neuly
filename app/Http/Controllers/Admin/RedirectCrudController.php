<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RedirectRecordRequest;
use App\Models\Redirect;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RedirectCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RedirectCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        if (! backpack_user()->can('manage redirects')) {
            abort(404);
        }

        CRUD::setModel(Redirect::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/redirect');
        CRUD::setEntityNameStrings('redirect', 'redirects');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'redirectable',
            'type' => 'relationship',
            'label' => 'Redirected to',
            'attribute' => 'name',
        ]);
        $this->crud->addColumn([
            'name' => 'old_slug',
            'type' => 'text',
            'label' => 'Old Slug',
        ]);
        $this->crud->addColumn([
            'name' => 'redirectable_type',
            'type' => 'text',
            'label' => 'Type',
        ]);
        $this->crud->addColumn(['name' => 'created_at']);
        $this->crud->addColumn(['name' => 'updated_at']);
    }

    public function setupShowOperation()
    {
        $this->setupListOperation();
    }

    protected function setupUpdateOperation()
    {
        CRUD::setValidation(RedirectRecordRequest::class);

        CRUD::field('old_slug');
    }
}
