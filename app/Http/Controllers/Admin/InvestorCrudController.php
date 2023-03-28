<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InvestorRequest;
use App\Models\Investor;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Support\Facades\Route;

class InvestorCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        if (! backpack_user()->can('edit investors')) {
            abort(404);
        }

        CRUD::setModel(Investor::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/investor');
        CRUD::setEntityNameStrings('investor', 'investors');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'name']);
        $this->crud->addColumn(['name' => 'type']);
        $this->crud->addColumn(['name' => 'website']);
        $this->crud->addColumn([
            'name' => 'created_at',
            'type' => 'date',
        ]);
        $this->crud->addColumn([
            'name' => 'updated_at',
            'type' => 'date',
        ]);
    }

    protected function setupShowOperation()
    {
        $investorId = Route::current()->parameter('id');
        $investor = Investor::find($investorId);

        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.investor_show_widget',
            'investor' => $investor,
        ])->to('before_content');

        $this->setupListOperation();
        $this->crud->addColumn([
            'label' => 'Logo',
            'name' => 'logo',
            'type' => 'image',
            'prefix' => Investor::getImageUrlPrefix(),
        ]);

        $this->crud->addButtonFromModelFunction('line', 'show_entity', 'getShowEntityPageButton', 'beginning');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(InvestorRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Name',
        ]);
        $this->crud->addField([
            'name' => 'website',
            'type' => 'text',
            'label' => 'Website',
        ]);
        $this->crud->addField([
            'name' => 'type',
            'type' => 'radio',
            'label' => 'Type',
            'options' => Investor::getTypeValues(),
            'inline' => true,
        ]);
        $this->crud->addField([
            'label' => 'Locations',
            'type' => 'relationship',
            'name' => 'locations',
            'attribute' => 'name',
        ]);
        $this->crud->addField([
            'label' => 'Companies',
            'type' => 'relationship',
            'name' => 'companies',
            'attribute' => 'name',
        ]);
        $this->crud->addField([
            'label' => 'Logo',
            'name' => 'logo',
            'type' => 'image',
            'upload' => true,
            'crop' => true,
            'aspect_ratio' => 0,
            'disk' => 'local',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
