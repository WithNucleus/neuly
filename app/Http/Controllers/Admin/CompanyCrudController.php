<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendNotification;
use App\Http\Controllers\Backpack\CRUD\Operations\UpdateOperationWithTouching;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\Investor;
use Backpack\CRUD\app\Http\Controllers\CrudController;
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
    use UpdateOperationWithTouching { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        if(!backpack_user()->can('edit companies')) {
            abort(404);
        }

        $this->crud->setModel('App\Models\Company');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/company');
        $this->crud->setEntityNameStrings('organization', 'organizations');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);

        $this->crud->addColumn([
            'label'     => 'Focus',
            'type'      => 'select_multiple',
            'name'      => 'focus',
            'entity'    => 'focus',
            'attribute' => 'name',
            'model'     => 'App\Models\Focus',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        $this->crud->addColumn(['name' => 'ownership', 'type' => 'text', 'label' => 'Type']);

        $this->crud->addColumn([
            'label'     => 'Location',
            'type'      => 'select_multiple',
            'name'      => 'locations',
            'entity'    => 'locations',
            'attribute' => 'name',
            'model'     => 'App\Models\Location',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        $this->crud->addColumn([
            'label'     => 'People',
            'type'      => 'select_multiple',
            'name'      => 'people',
            'entity'    => 'people',
            'attribute' => 'name',
            'model'     => 'App\Models\Person',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        $companyId = Route::current()->parameter('id');
        $company = Company::with(['people', 'parents', 'subsidiaries'])->findOrFail($companyId);

        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.company_show_widget',
            'company' => $company
        ])->to('before_content');

        $this->crud->addColumn('ownership');
        $this->crud->addColumn('ticker_symbol');
        $this->crud->addColumn([
            'name' => 'founded_date',
            'type' => 'date',
            'label' => 'Founded Date'
        ]);
        $this->crud->addColumn([
            'name' => 'valuation',
            'type' => 'number',
            'label' => 'Valuation',
            'prefix'     => "$",
        ]);
        $this->crud->addColumn([
            'name' => 'total_funding_amount',
            'type' => 'number',
            'label' => 'Total Funding Amount',
            'prefix'     => "$",
        ]);
        $this->crud->addColumn([
            'name' => 'last_funding_date',
            'type' => 'date',
            'label' => 'Last Funding Date'
        ]);
        $this->crud->addColumn([
            'name' => 'number_employees',
            'type' => 'number',
            'label' => '# of Employees'
        ]);
        $this->crud->addColumn([
            'name' => 'summary',
            'type' => 'textarea',
            'label' => 'Summary'
        ]);
        $this->crud->addColumn([
            'name' => 'notes',
            'type' => 'textarea',
            'label' => 'Notes'
        ]);
        $this->crud->addColumn([
            'label'        => "Logo",
            'name'         => "logo",
            'type'         => 'image',
            'prefix'       => Company::getImageUrlPrefix()
        ]);

        $this->crud->addButtonFromModelFunction('line', 'show_entity', 'getShowEntityPageButton', 'beginning');

        $this->crud->addColumn([
            'name' => 'visibility',
            'type' => 'text',
            'label' => 'Visibility'
        ]);

        $this->crud->addColumn([
            'name' => 'visibility_code',
            'type' => 'text',
            'label' => 'Visibility Code'
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(CompanyRequest::class);

        $this->crud->addField([
            'name'  => 'name',
            'type'  => 'text',
            'label' => 'Name'
        ]);
        $this->crud->addField([
            'name'    => 'ownership',
            'type'    => 'radio',
            'label'   => 'Type',
            'options' => Company::getOwnershipValues(),
            'inline'  => true,
        ]);
        $this->crud->addField([
            'label'     => "Focus",
            'type'      => 'select2_multiple',
            'name'      => 'focus',
            'entity'    => 'focus',
            'attribute' => 'name',

            'pivot'   => true,
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'model'   => "App\Models\Focus",
        ]);
        $this->crud->addField([
            'label'     => "Locations",
            'type'      => 'select2_multiple',
            'name'      => 'locations',
            'entity'    => 'locations',
            'attribute' => 'name',

            'pivot' => true,

            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'model'   => "App\Models\Location",
        ]);
        $this->crud->addField([
            'label'     => "Investors",
            'type'      => 'select2_multiple',
            'name'      => 'investors',
            'entity'    => 'investors',
            'attribute' => 'name',
            'pivot'     => true,

            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'model'   => "App\Models\Investor",
        ]);
        $this->crud->addField([
            'name'  => 'ticker_symbol',
            'type'  => 'text',
            'label' => 'Ticker Symbol'
        ]);
        $this->crud->addField([
            'name'  => 'website',
            'type'  => 'text',
            'label' => 'Website'
        ]);
        $this->crud->addField([
            'name'  => 'founded_date',
            'type'  => 'date_picker',
            'label' => 'Founded Date',
            'date_picker_options' => [
                'format' => config('app.datepicker_input_format'),
            ],
        ]);
        $this->crud->addField([
            'name'   => 'valuation',
            'type'   => 'number',
            'label'  => 'Valuation',
            'prefix' => "$",
        ]);
        $this->crud->addField([
            'name'   => 'total_funding_amount',
            'type'   => 'number',
            'label'  => 'Total Funding Amount',
            'prefix' => "$",
        ]);
        $this->crud->addField([
            'name'  => 'last_funding_date',
            'type'  => 'date_picker',
            'label' => 'Last Funding Date',
            'date_picker_options' => [
                'format' => config('app.datepicker_input_format'),
            ],
        ]);
        $this->crud->addField([
            'name'  => 'number_employees',
            'type'  => 'number',
            'label' => '# of Employees'
        ]);
        $this->crud->addField([
            'name'  => 'summary',
            'type'  => 'textarea',
            'label' => 'Summary'
        ]);
        $this->crud->addField([
            'name'  => 'notes',
            'type'  => 'textarea',
            'label' => 'Notes'
        ]);
        $this->crud->addField([
            'label'        => "Logo",
            'name'         => "logo",
            'type'         => 'image',
            'upload'       => true,
            'crop'         => true,
            'aspect_ratio' => 0,
            'prefix'       => Company::getImageUrlPrefix(),
        ]);
        $this->crud->addField([
            'name'    => 'visibility',
            'type'    => 'radio',
            'label'   => 'Visibility',
            'options' => Company::getVisibilityValues(),
            'inline'  => true,
        ]);
        $this->crud->addField([
            'name'  => 'visibility_code',
            'type'  => 'text',
            'label' => 'Visibility Code'
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

                $description = $company->getShowLink() . ' is ' . $company->getTypeDescription() . ' with a focus on ' . $focus->getShowLink() . '.';

                SendNotification::dispatch($focus, $title, $description, 'focus');
            }
        }

        if($request->has('investors') && $request->input('investors') !== null) {
            foreach($request->input('investors') as $investorId) {

                $investor = Investor::find($investorId);

                $title = 'A new organization has been added to ' . $investor->name;

                $description = $investor->getShowLink() . ' is investing in ' . $company->getShowLink() . ', ' . $company->getTypeDescription() . '.';

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

                $description = $investor->getShowLink() . ' is an investor in ' . $company->getShowLink() . ', ' . $company->getTypeDescription() . '.';

                SendNotification::dispatch($investor, $title_investor, $description, 'investors');
                SendNotification::dispatch($company, $title_organization, $description, 'organizations');
            }
        }

        if($removedInvestors !== [])
        {
            foreach($removedInvestors as $key => $investorId)
            {
                $investor = Investor::find($investorId);

                $title = $investor->name . ' was removed as an investor for ' . $company->name;

                $description = $investor->getShowLink() . ' was removed as an investor in ' . $company->getShowLink() . ', ' . $company->getTypeDescription() . '.';

                SendNotification::dispatch($investor, $title, $description, 'investors');
                SendNotification::dispatch($company, $title, $description, 'organizations');
            }
        }

        if($addedFocus !== [])
        {
            foreach($addedFocus as $key => $focusId)
            {
                $focus = Focus::find($focusId);

                $title_focus = $focus->name . ' was added to an organization';
                $title_company = $company->name . ' has a new focus';

                $description = $company->getShowLink() . ' is ' . $company->getTypeDescription() . ' with a focus on ' . $focus->getShowLink() . '.';

                SendNotification::dispatch($focus, $title_focus, $description, 'focus');
                SendNotification::dispatch($company, $title_company, $description, 'organizations');
            }
        }

        if($removedFocus !== [])
        {
            foreach($removedFocus as $key => $focusId)
            {
                $focus = Focus::find($focusId);

                $title = $focus->name . ' was removed from ' . $company->name;

                if ($company->ownership === 'Privately Held') {
                    $company_ownership = 'a privately held organization';
                } elseif ($company->ownership === 'Educational Institution') {
                    $company_ownership = 'an ' . $company->ownership;
                } else {
                    $company_ownership = 'a ' . $company->ownership;
                }

                $description = $company->getShowLink() . ', ' . $company->getTypeDescription() . ' is no longer focusing on ' . $focus->getShowLink() . '.';

                SendNotification::dispatch($focus, $title, $description, 'focus');
                SendNotification::dispatch($company, $title, $description, 'organizations');
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
