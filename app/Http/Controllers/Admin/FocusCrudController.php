<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FocusRequest;
use App\Models\Focus;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

/**
 * Class FocusCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FocusCrudController extends CrudController
{

    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {

        // Check Guard
        if(!backpack_user()->can('edit focus categories')) {
            abort(404);
        }

        $this->crud->setModel('App\Models\Focus');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/focus');
        $this->crud->setEntityNameStrings('focus', 'focus categories');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addColumn(['name' => 'slug', 'type' => 'text', 'label' => 'Slug']);
        $this->crud->addColumn(['name' => 'type', 'type' => 'text', 'label' => 'Type']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(FocusRequest::class);

        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.updateSlug',
            'field_name' => 'name' // field name to generate slug
        ])->to('before_content');

        $this->crud->addField(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addField(['name' => 'slug', 'type' => 'text', 'label' => 'Slug']);
        $this->crud->addField([
            'name' => 'type',
            'type' => 'select_from_array',
            'label' => 'Type',
            'options' => ['', Focus::TYPE_DRUG => Focus::TYPE_DRUG],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
