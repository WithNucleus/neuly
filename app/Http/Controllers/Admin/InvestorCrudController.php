<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendNotification;
use App\Http\Controllers\Backpack\CRUD\Operations\UpdateOperationWithTouching;
use App\Http\Requests\InvestorRequest;
use App\Models\Company;
use App\Models\Investor;
use App\Models\Location;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Support\Facades\Route;

/**
 * Class InvestorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class InvestorCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use UpdateOperationWithTouching { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        if(!backpack_user()->can('edit investors')) {
            abort(404);
        }

        CRUD::setModel(Investor::class);
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
        $investorId = Route::current()->parameter('id');
        $investor = Investor::find($investorId);

        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.investor_show_widget',
            'investor' => $investor
        ])->to('before_content');

        $this->setupListOperation();
        $this->crud->addColumn([
            'label'        => "Logo",
            'name'         => "logo",
            'type'         => 'image',
            'prefix'       => Investor::getImageUrlPrefix(),
        ]);

        $this->crud->addButtonFromModelFunction('line', 'show_entity', 'getShowEntityPageButton', 'beginning');
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

        $this->crud->addField([
            'name'  => 'name',
            'type'  => 'text',
            'label' => 'Name'
        ]);
        $this->crud->addField([
            'name'  => 'website',
            'type'  => 'text',
            'label' => 'Website'
        ]);
        $this->crud->addField([
            'name'    => 'type',
            'type'    => 'radio',
            'label'   => 'Type',
            'options' => Investor::getTypeValues(),
            'inline'  => true,
        ]);
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
        $this->crud->addField([
            'label'        => "Logo",
            'name'         => "logo",
            'type'         => 'image',
            'upload'       => true,
            'crop'         => true,
            'aspect_ratio' => 0,
            'disk'         => 'local',
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

                $title = 'New investor in ' . $location->name;

                $description = $investor->getShowLink() . ' is a new investor located in ' . $location->getShowLink();

                SendNotification::dispatch($location, $title, $description, 'locations');
            }
        }

        if($request->has('companies') && $request->input('companies') !== null) {
            foreach($request->input('companies') as $companyId) {
                $company = Company::find($companyId);

                $title = 'New investor for ' . $company->name;

                $description = $investor->getShowLink() . ' is a recently added investor in ' . $company->getShowLink() . ', ' . $company->getTypeDescription() . '.';

                SendNotification::dispatch($company, $title, $description, 'organizations');
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
                $company = Company::find($companyId);

                $title_investor = $investor->name . ' was removed from an organization';
                $title_company = $company->name . ' removed an investor';

                $description = $investor->getShowLink() . ' is no longer an investor in ' . $company->getShowLink();

                SendNotification::dispatch($investor, $title_investor, $description, 'investors');
                SendNotification::dispatch($company, $title_company, $description, 'organizations');
            }
        }

        if($addedCompanies !== [])
        {
            foreach($addedCompanies as $key => $companyId)
            {
                $company = Company::find($companyId);

                $title_investor = $investor->name . ' was added to an organization';
                $title_company = $company->name . ' has a new investor';

                $description = $investor->getShowLink() . ' is now an investor in ' . $company->getShowLink();

                SendNotification::dispatch($investor, $title_investor, $description, 'investors');
                SendNotification::dispatch($company, $title_company, $description, 'organizations');
            }
        }

        if($removedLocations !== [])
        {
            foreach($removedLocations as $key => $locationId)
            {
                $location = Location::find($locationId);

                $title_investor = $investor->name . ' removed a location';
                $title_location = $location->name . ' lost an investor';

                $description = $investor->getShowLink() . ' is no longer located in ' . $location->getShowLink();

                SendNotification::dispatch($location, $title_location, $description, 'locations');
                SendNotification::dispatch($investor, $title_investor, $description, 'investors');
            }
        }

        if($addedLocations !== [])
        {
            foreach($addedLocations as $key => $locationId)
            {
                $location = Location::find($locationId);

                $title_investor = $investor->name . ' added a location';
                $title_location = 'Investor is located in ' . $location->name;

                $description = $investor->getShowLink() . ' is now located in ' . $location->getShowLink();

                SendNotification::dispatch($location, $title_location, $description, 'locations');
                SendNotification::dispatch($investor, $title_investor, $description, 'investors');
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
