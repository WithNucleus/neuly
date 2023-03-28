<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Support\Facades\Route;

class CompanyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        if (! backpack_user()->can('edit companies')) {
            abort(404);
        }

        CRUD::setModel(\App\Models\Company::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/company');
        CRUD::setEntityNameStrings('organization', 'organizations');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'id', 'type' => 'text', 'label' => 'ID']);
        $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);

        $this->crud->addColumn([
            'label' => 'Focus',
            'type' => 'select_multiple',
            'name' => 'focus',
            'entity' => 'focus',
            'attribute' => 'name',
            'model' => \App\Models\Focus::class,
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        $this->crud->addColumn(['name' => 'ownership', 'type' => 'text', 'label' => 'Type']);

        $this->crud->addColumn([
            'label' => 'Location',
            'type' => 'select_multiple',
            'name' => 'locations',
            'entity' => 'locations',
            'attribute' => 'name',
            'model' => \App\Models\Location::class,
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        $this->crud->addColumn([
            'label' => 'People',
            'type' => 'select_multiple',
            'name' => 'people',
            'entity' => 'people',
            'attribute' => 'name',
            'model' => \App\Models\Person::class,
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
    }

    public function setupShowOperation() {
        $this->crud->set('show.setFromDb', false);

        $companyId = Route::current()->parameter('id');
        $company = Company::with(['people', 'parents', 'subsidiaries'])->findOrFail($companyId);

        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.company_show_widget',
            'company' => $company,
        ])->to('before_content');

        $this->crud->addColumn('ownership');
        $this->crud->addColumn('ticker_symbol');
        $this->crud->addColumn([
            'name' => 'founded_date',
            'type' => 'date',
            'label' => 'Founded Date',
        ]);
        $this->crud->addColumn([
            'name' => 'valuation',
            'type' => 'number',
            'label' => 'Valuation',
            'prefix' => '$',
        ]);
        $this->crud->addColumn([
            'name' => 'total_funding_amount',
            'type' => 'number',
            'label' => 'Total Funding Amount',
            'prefix' => '$',
        ]);
        $this->crud->addColumn([
            'name' => 'last_funding_date',
            'type' => 'date',
            'label' => 'Last Funding Date',
        ]);
        $this->crud->addColumn([
            'name' => 'number_employees',
            'type' => 'number',
            'label' => '# of Employees',
        ]);
        $this->crud->addColumn([
            'name' => 'summary',
            'type' => 'textarea',
            'label' => 'Summary',
        ]);
        $this->crud->addColumn([
            'name' => 'notes',
            'type' => 'textarea',
            'label' => 'Notes',
        ]);
        $this->crud->addColumn([
            'label' => 'Logo',
            'name' => 'logo',
            'type' => 'image',
            'prefix' => Company::getImageUrlPrefix(),
        ]);

        $this->crud->addButtonFromModelFunction('line', 'show_entity', 'getShowEntityPageButton', 'beginning');

        $this->crud->addColumn([
            'name' => 'visibility',
            'type' => 'text',
            'label' => 'Visibility',
        ]);

        $this->crud->addColumn([
            'name' => 'visibility_code',
            'type' => 'text',
            'label' => 'Visibility Code',
        ]);

        $this->crud->addColumn([
            'name' => 'facebook',
            'type' => 'text',
            'label' => 'Facebook',
        ]);

        $this->crud->addColumn([
            'name' => 'instagram',
            'type' => 'text',
            'label' => 'Instagram',
        ]);

        $this->crud->addColumn([
            'name' => 'linkedin',
            'type' => 'text',
            'label' => 'LinkedIn',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(CompanyRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Name',
        ]);
        $this->crud->addField([
            'name' => 'ownership',
            'type' => 'radio',
            'label' => 'Type',
            'options' => Company::getOwnershipValues(),
            'inline' => true,
        ]);
        $this->crud->addField([
            'label' => 'Focus',
            'type' => 'relationship',
            'name' => 'focus',
            'attribute' => 'name',
        ]);
        $this->crud->addField([
            'label' => 'Locations',
            'type' => 'relationship',
            'name' => 'locations',
            'attribute' => 'name',
        ]);
        $this->crud->addField([
            'label' => 'Investors',
            'type' => 'relationship',
            'name' => 'investors',
            'attribute' => 'name',
        ]);
        $this->crud->addField([
            'name' => 'ticker_symbol',
            'type' => 'text',
            'label' => 'Ticker Symbol',
        ]);
        $this->crud->addField([
            'name' => 'website',
            'type' => 'text',
            'label' => 'Website',
        ]);
        $this->crud->addField([
            'name' => 'founded_date',
            'type' => 'date_picker',
            'label' => 'Founded Date',
            'date_picker_options' => [
                'format' => config('app.datepicker_input_format'),
            ],
        ]);
        $this->crud->addField([
            'name' => 'valuation',
            'type' => 'number',
            'label' => 'Valuation',
            'prefix' => '$',
        ]);
        $this->crud->addField([
            'name' => 'total_funding_amount',
            'type' => 'number',
            'label' => 'Total Funding Amount',
            'prefix' => '$',
        ]);
        $this->crud->addField([
            'name' => 'last_funding_date',
            'type' => 'date_picker',
            'label' => 'Last Funding Date',
            'date_picker_options' => [
                'format' => config('app.datepicker_input_format'),
            ],
        ]);
        $this->crud->addField([
            'name' => 'number_employees',
            'type' => 'number',
            'label' => '# of Employees',
        ]);
        $this->crud->addField([
            'name' => 'summary',
            'type' => 'textarea',
            'label' => 'Summary',
        ]);
        $this->crud->addField([
            'name' => 'notes',
            'type' => 'textarea',
            'label' => 'Notes',
        ]);
        $this->crud->addField([
            'label' => 'Logo',
            'name' => 'logo',
            'type' => 'image',
            'upload' => true,
            'crop' => true,
            'aspect_ratio' => 0,
            'prefix' => Company::getImageUrlPrefix(),
        ]);
        $this->crud->addField([
            'name' => 'visibility',
            'type' => 'radio',
            'label' => 'Visibility',
            'options' => Company::getVisibilityValues(),
            'default' => Company::VISIBILITY_PUBLIC,
            'inline' => true,
        ]);
        $this->crud->addField([
            'name' => 'visibility_code',
            'type' => 'text',
            'label' => 'Visibility Code',
        ]);
        $this->crud->addField([
            'name' => 'facebook',
            'type' => 'text',
            'label' => 'Facebook',
        ]);
        $this->crud->addField([
            'name' => 'instagram',
            'type' => 'text',
            'label' => 'Instagram',
        ]);
        $this->crud->addField([
            'name' => 'linkedin',
            'type' => 'text',
            'label' => 'LinkedIn',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
