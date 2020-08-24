<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendNotification;
use App\Http\Requests\InvestorRequest;
use App\Models\Company;
use App\Models\Investor;
use App\Models\Location;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

/**
 * Class InvestorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class InvestorCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
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
        if(!backpack_user()->can('edit investors')) {
            abort(404);
        }

        CRUD::setModel(\App\Models\Investor::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/investor');
        CRUD::setEntityNameStrings('investor', 'investors');

    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        $this->crud->addColumn(['name' => 'name']);
        $this->crud->addColumn(['name' => 'type']);
        $this->crud->addColumn(['name' => 'website']);

        $this->crud->addColumn([
            'name' => 'created_at',
            'type' => 'date'
        ]);

        $this->crud->addColumn([
            'name' => 'updated_at',
            'type' => 'date'
        ]);

    }

    /**
     * Define what happens when the Show operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupShowOperation()
    {
        $request = \Request::getPathInfo();
        $request_array = explode('/', $request);
        $this_investor_id = $request_array[3];
        $investor = \App\Models\Investor::find($this_investor_id);

        // Company People Widget
        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.investor_show_widget',
            'investor' => $investor
        ])->to('before_content');

        $this->setupListOperation();

        // Logo
        $this->crud->addColumn([
            'label'        => "Logo",
            'name'         => "logo",
            'type'         => 'image',
            'prefix'       => 'storage/'
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(InvestorRequest::class);

        // Name
        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Name'
        ]);

        // Website
        $this->crud->addField([
            'name' => 'website',
            'type' => 'text',
            'label' => 'Website'
        ]);

        // Type
        $this->crud->addField([
            'name' => 'type',
            'type' => 'radio',
            'label' => 'Type',
            'options'     => [
                'Venture Capital' => 'Venture Capital',
                'Private Equity' => 'Private Equity',
                'Private Individual' => 'Private Individual',
            ],
            'inline' => true,
        ]);

        // Location Relationship
        $this->crud->addField([
             'label'     => "Locations",
             'type'      => 'select2_multiple',
             'name'      => 'locations',
             'entity'    => 'locations',
             'attribute' => 'name',
             'pivot'     => true,
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'model'     => "App\Models\Location", // foreign key model
        ]);

        // Company Relationship
        $this->crud->addField([
             'label'     => "Companies",
             'type'      => 'select2_multiple',
             'name'      => 'companies',
             'entity'    => 'companies',
             'attribute' => 'name',
             'pivot'     => true,
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'model'     => "App\Models\Company",
        ]);

        // Logo
        $this->crud->addField([
            'label'        => "Logo",
            'name'         => "logo",
            'type'         => 'image',
            'upload'       => true,
            'crop'         => true,
            'aspect_ratio' => 0,
            'disk'      => 'local',
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
        $this->setupCreateOperation();
    }

    public function store()
    {
        $response = $this->traitStore();
        $request = $response->getRequest();

        $investor = $this->data['entry'];

        if($request->has('locations') && $request->input('locations') !== null) {
            foreach($request->input('locations') as $locationId) {
                $location = Location::find($locationId);
                SendNotification::dispatch($location, 'A new investor has been added to location.', 'some long description');
            }
        }

        if($request->has('companies') && $request->input('companies') !== null) {
            foreach($request->input('companies') as $companyId) {
                $company = Company::find($companyId);
                SendNotification::dispatch($company, 'A new investor has been added to company.', 'some long description');
            }
        }

        return $response;
    }

    public function update()
    {

        $originalInvestor = $this->getOriginalModel($this->crud);
        $oldCompanies= $this->getCompanyIds($originalInvestor);
        $oldLocations = $this->getLocationIds($originalInvestor);


        $response = $this->traitUpdate();
        $request = $response->getRequest();

        $investor = $this->data['entry'];
        $newCompanies = $this->getCompanyIds($investor);
        $newLocations = $this->getLocationIds($investor);

        $addedCompanies = array_diff($newCompanies, $oldCompanies);
        $removedCompanies = array_diff($oldCompanies, $newCompanies);
        $addedLocations = array_diff($newLocations, $oldLocations);
        $removedLocations = array_diff($oldLocations, $newLocations);

        if($removedCompanies !== [])
        {
            foreach($removedCompanies as $key => $companyId)
            {
                $title = 'Investor was removed from company';

                $company= Company::find($companyId);
                SendNotification::dispatch($investor, $title, 'some long description');
                SendNotification::dispatch($company, $title, 'some long description');
            }
        }

        if($addedCompanies !== [])
        {
            foreach($addedCompanies as $key => $companyId)
            {
                $title = 'Investor was added to company';

                $company= Company::find($companyId);
                SendNotification::dispatch($investor, $title, 'some long description');
                SendNotification::dispatch($company, $title, 'some long description');
            }
        }

        if($removedLocations !== [])
        {
            foreach($removedLocations as $key => $locationId)
            {
                $title = 'Location was removed from investor';

                $location = Location::find($locationId);
                SendNotification::dispatch($location, $title, 'some long description');
                SendNotification::dispatch($company, $title, 'some long description');
            }
        }

        if($addedLocations !== [])
        {
            foreach($addedLocations as $key => $locationId)
            {
                $title = 'Location was added to investor';

                $location = Location::find($locationId);
                SendNotification::dispatch($location, $title, 'some long description');
                SendNotification::dispatch($company, $title, 'some long description');
            }
        }

        return $response;
    }

    private function getCompanyIds($model)
    {
        return $model->companies()->pluck('company_id')->toArray();
    }

    private function getLocationIds($model)
    {
        return $model->locations()->pluck('location_id')->toArray();
    }

    private function getOriginalModel($crud)
    {
        $request = $crud->validateRequest();
        return Investor::find($request->get($crud->model->getKeyName()));
    }
}