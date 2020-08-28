<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendNotification;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\Investor;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Focus;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Support\Facades\Route;

/**
 * Class CompanyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CompanyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;


    public function setup()
    {

        // Check Guard
        if(!backpack_user()->can('edit companies')) {
            abort(404);
        }

        $this->crud->setModel('App\Models\Company');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/company');
        $this->crud->setEntityNameStrings('organization', 'organizations');

        // List
        $this->crud->operation('list', function() {

            // Name
            $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);

            // Focus -- Relationship
            $this->crud->addColumn([
               'label'     => 'Focus',
               'type'      => 'select_multiple',
               'name'      => 'focus',
               'entity'    => 'focus',
               'attribute' => 'name',
               'model'     => 'App\Models\Focus',
               // 'orderable' => true,
               'options'   => (function ($query) {
                    return $query->orderBy('name', 'ASC')->get();
                }),
            ]);

            // Type
            $this->crud->addColumn(['name' => 'ownership', 'type' => 'text', 'label' => 'Type']);

            // Location -- Relationship
            $this->crud->addColumn([
               'label'     => 'Location',
               'type'      => 'select_multiple',
               'name'      => 'locations',
               'entity'    => 'locations',
               'attribute' => 'name',
               'model'     => 'App\Models\Location',
               // 'orderable' => true,
               'options'   => (function ($query) {
                    return $query->orderBy('name', 'ASC')->get();
                }),
            ]);

            // People -- When it's Many to Many Relationship
            $this->crud->addColumn([
               'label'     => 'People',
               'type'      => 'select_multiple',
               'name'      => 'people',
               'entity'    => 'people',
               'attribute' => 'name',
               'model'     => 'App\Models\Person',
               // 'orderable' => true,
               'options'   => (function ($query) {
                    return $query->orderBy('name', 'ASC')->get();
                }),
            ]);

        });

    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        // Get this ID
        $request = \Request::getPathInfo();
        $request_array = explode('/', $request);
        $this_company_id = $request_array[3];

        // Get this Company
        $company = \App\Models\Company::find($this_company_id);

        // Company People Widget
        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.company_show_widget',
            'company' => $company
        ])->to('before_content');

        // Ownership
        $this->crud->addColumn('ownership');

        // Ticker Symbol
        $this->crud->addColumn('ticker_symbol');

        // Founded Date
        $this->crud->addColumn([
            'name' => 'founded_date',
            'type' => 'date',
            'label' => 'Founded Date'
        ]);

        // Valuation
        $this->crud->addColumn([
            'name' => 'valuation',
            'type' => 'number',
            'label' => 'Valuation',
            'prefix'     => "$",
        ]);

        // Total Funding Amount
        $this->crud->addColumn([
            'name' => 'total_funding_amount',
            'type' => 'number',
            'label' => 'Total Funding Amount',
            'prefix'     => "$",
        ]);

        // Last Funding Date
        $this->crud->addColumn([
            'name' => 'last_funding_date',
            'type' => 'date',
            'label' => 'Last Funding Date'
        ]);

        // Number Employees
        $this->crud->addColumn([
            'name' => 'number_employees',
            'type' => 'number',
            'label' => '# of Employees'
        ]);

        // Summary
        $this->crud->addColumn([
            'name' => 'summary',
            'type' => 'textarea',
            'label' => 'Summary'
        ]);

        // Notes
        $this->crud->addColumn([
            'name' => 'notes',
            'type' => 'textarea',
            'label' => 'Notes'
        ]);

        // Logo
        $this->crud->addColumn([
            'label'        => "Logo",
            'name'         => "logo",
            'type'         => 'image',
            'prefix'       => 'storage/'
        ]);

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(CompanyRequest::class);

        // Name
        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Name'
        ]);

        // Ownership
        $this->crud->addField([
            'name' => 'ownership',
            'type' => 'radio',
            'label' => 'Type',
            'options'     => [
                'Public Company' => 'Public Company',
                'Privately Held' => 'Privately Held',
                'Educational Institution' => 'Educational Institution',
                'Government Agency' => 'Government Agency',
                'Non-Profit' => 'Non-Profit'
            ],
            'inline' => true,
        ]);

        // Focus
        $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
             'label'     => "Focus",
             'type'      => 'select2_multiple',
             'name'      => 'focus', // the method that defines the relationship in your Model
             'entity'    => 'focus', // the method that defines the relationship in your Model
             'attribute' => 'name', // foreign key attribute that is shown to user

             'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
             // 'select_all' => true, // show Select All and Clear buttons?
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),

             // optional
             'model'     => "App\Models\Focus", // foreign key model
        ]);

        // Location Relationship
        $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
             'label'     => "Locations",
             'type'      => 'select2_multiple',
             'name'      => 'locations', // the method that defines the relationship in your Model
             'entity'    => 'locations', // the method that defines the relationship in your Model
             'attribute' => 'name', // foreign key attribute that is shown to user

             'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
             // 'select_all' => true, // show Select All and Clear buttons?
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),

             // optional
             'model'     => "App\Models\Location", // foreign key model
        ]);

        // Investor Relationship
        $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
             'label'     => "Investors",
             'type'      => 'select2_multiple',
             'name'      => 'investors', // the method that defines the relationship in your Model
             'entity'    => 'investors', // the method that defines the relationship in your Model
             'attribute' => 'name', // foreign key attribute that is shown to user

             'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
             // 'select_all' => true, // show Select All and Clear buttons?
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),

             // optional
             'model'     => "App\Models\Investor", // foreign key model
        ]);

        // Ticker Symbol
        $this->crud->addField([
            'name' => 'ticker_symbol',
            'type' => 'text',
            'label' => 'Ticker Symbol'
        ]);

        // Website
        $this->crud->addField([
            'name' => 'website',
            'type' => 'text',
            'label' => 'Website'
        ]);

        // Founded Date
        $this->crud->addField([
            'name' => 'founded_date',
            'type' => 'date',
            'label' => 'Founded Date'
        ]);

        // Valuation
        $this->crud->addField([
            'name' => 'valuation',
            'type' => 'number',
            'label' => 'Valuation',
            'prefix'     => "$",
        ]);

        // Total Funding Amount
        $this->crud->addField([
            'name' => 'total_funding_amount',
            'type' => 'number',
            'label' => 'Total Funding Amount',
            'prefix'     => "$",
        ]);

        // Last Funding Date
        $this->crud->addField([
            'name' => 'last_funding_date',
            'type' => 'date',
            'label' => 'Last Funding Date'
        ]);

        // Number Employees
        $this->crud->addField([
            'name' => 'number_employees',
            'type' => 'number',
            'label' => '# of Employees'
        ]);

        // Summary
        $this->crud->addField([
            'name' => 'summary',
            'type' => 'textarea',
            'label' => 'Summary'
        ]);

        // Notes
        $this->crud->addField([
            'name' => 'notes',
            'type' => 'textarea',
            'label' => 'Notes'
        ]);

        // Logo
        $this->crud->addField([
            'label'        => "Logo",
            'name'         => "logo",
            'type'         => 'image',
            'upload'       => true,
            'crop'         => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 0, // ommit or set to 0 to allow any aspect ratio
            'disk'      => 'local', // in case you need to show images from a different disk
            // 'prefix'    => 'storage/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
        ]);
    }

    public function store()
    {
        $response = $this->traitStore();
        $request = $response->getRequest();

        $company = $this->data['entry'];

        if($request->has('focus') && $request->input('focus') !== null) {
            foreach($request->input('focus') as $focusId) {

                $focus = Focus::find($focusId);

                $title = $focus->name . ' has a new organization';

                $description = '<a href="' . route('discover.organizations.show', $company->slug) . '">' . $company->name . '</a> is a ' . $company->ownership . ' with a focus on <a href="' . route('discover.focus.show', $focus->slug) . '">' . $focus->name . '</a>';

                SendNotification::dispatch($focus, $title, $description, 'focus');
            }
        }

        if($request->has('investors') && $request->input('investors') !== null) {
            foreach($request->input('investors') as $investorId) {

                $investor = Investor::find($investorId);

                $title = 'A new organization has been added to ' . $investor->name;

                $description = '<a href="' . route('discover.investors.show', $investor->slug) . '">' . $investor->name . '</a> is investing in recently added ' . $company->ownership  . ' <a href="' . route('discover.organizations.show', $company->slug) . '">' . $company->name . '</a>';

                SendNotification::dispatch($investor, $title, $description, 'investors');
            }
        }

        return $response;
    }

    public function update()
    {

        $originalCompany = $this->getOriginalModel($this->crud);
        $oldInvestors = $this->getInvestorIds($originalCompany);
        $oldFocus = $this->getFocusIds($originalCompany);

        $response = $this->traitUpdate();
        $request = $response->getRequest();

        $company = $this->data['entry'];
        $newInvestors = $this->getInvestorIds($company);
        $newFocus = $this->getFocusIds($company);

        $addedInvestors = array_diff($newInvestors, $oldInvestors);
        $removedInvestors = array_diff($oldInvestors, $newInvestors);
        $addedFocus = array_diff($newFocus, $oldFocus);
        $removedFocus = array_diff($oldFocus, $newFocus);

        if($addedInvestors !== [])
        {
            foreach($addedInvestors as $key => $investorId)
            {
                $investor = Investor::find($investorId);

                $title_investor = $investor->name . ' was added to an organization';
                $title_organization = $company->name . ' has a new investor';

                $description = $investor->name . ' is an investor in ' . $company->name . ', a ' . $company->ownership . ' organization.';

                SendNotification::dispatch($investor, $title_investor, $description);
                SendNotification::dispatch($company, $title_organization, $description);
            }
        }

        if($removedInvestors !== [])
        {
            foreach($removedInvestors as $key => $investorId)
            {
                $investor = Investor::find($investorId);

                $title = $investor->name . ' was removed as an investor for ' . $company->name;
                $description = '';

                SendNotification::dispatch($investor, $title, $description);
                SendNotification::dispatch($company, $title, $description);
            }
        }

        if($addedFocus !== [])
        {
            foreach($addedFocus as $key => $focusId)
            {
                $focus = Focus::find($focusId);

                $title_focus = $focus->name . ' was added to an organization';
                $title_company = $company->name . ' has a new focus';
                $description = $company->name . ' is a ' . $company->ownership . '  organization with a focus on ' . $focus->name;

                SendNotification::dispatch($focus, $title_focus, $description);
                SendNotification::dispatch($company, $title_company, $description);
            }
        }

        if($removedFocus !== [])
        {
            foreach($removedFocus as $key => $focusId)
            {
                $focus = Focus::find($focusId);

                $title = $focus->name . ' was removed from ' . $company->name;
                $description = '';

                SendNotification::dispatch($focus, $title, $description);
                SendNotification::dispatch($company, $title, $description);
            }
        }

        return $response;
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    private function getInvestorIds($model)
    {
        return $model->investors()->pluck('investor_id')->toArray();
    }

    private function getFocusIds($model)
    {
        return $model->focus()->pluck('focus_id')->toArray();
    }

    private function getOriginalModel($crud)
    {
        $request = $crud->validateRequest();
        return Company::find($request->get($crud->model->getKeyName()));
    }
}
