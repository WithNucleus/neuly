<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ResearchRequest;
use App\Models\Research;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ResearchCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        if (! backpack_user()->can('edit research')) {
            abort(404);
        }

        CRUD::setModel(Research::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/research');
        CRUD::setEntityNameStrings('research', 'research');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Name/Title',
            'type' => 'text',
        ]);
        $this->crud->addColumn([
            'label' => 'Focus',
            'type' => 'relationship',
            'name' => 'focus',
            'attribute' => 'name',
        ]);
        $this->crud->addColumn([
            'label' => 'Companies',
            'type' => 'relationship',
            'name' => 'companies',
            'attribute' => 'name',
        ]);
        $this->crud->addColumn([
            'label' => 'People',
            'type' => 'relationship',
            'name' => 'people',
            'attribute' => 'name',
        ]);
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();

        $this->crud->addColumn([
            'name' => 'link',
            'label' => 'Link',
            'type' => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'abstract',
            'label' => 'Abstract',
            'type' => 'text',
        ]);

        $this->crud->addButtonFromModelFunction('line', 'show_entity', 'getShowEntityPageButton', 'beginning');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(ResearchRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'label' => 'Name/Title',
            'type' => 'text',
        ]);
        $this->crud->addField([
            'name' => 'link',
            'label' => 'Link',
            'type' => 'url',
        ]);
        $this->crud->addField([
            'name' => 'abstract',
            'label' => 'Abstract',
            'type' => 'textarea',
        ]);
        $this->crud->addField([
            'label' => 'Focus',
            'type' => 'relationship',
            'name' => 'focus',
            'attribute' => 'name',
        ]);
        $this->crud->addField([
            'label' => 'Companies',
            'type' => 'relationship',
            'name' => 'companies',
            'attribute' => 'name',
        ]);
        $this->crud->addField([
            'label' => 'People',
            'type' => 'relationship',
            'name' => 'people',
            'attribute' => 'name',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
