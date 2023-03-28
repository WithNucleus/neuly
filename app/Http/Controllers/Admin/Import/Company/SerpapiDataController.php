<?php

namespace App\Http\Controllers\Admin\Import\Company;

use App\Helpers\Entity\FieldsMapping;
use App\Helpers\ListingRequestHelper;
use App\Models\Company;
use App\Models\CompanySerpapiData;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use Prologue\Alerts\Facades\Alert;

class SerpapiDataController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    public function setup()
    {
        $this->crud->setModel(CompanySerpapiData::class);
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/import/company/serpapi-data');
        $this->crud->setEntityNameStrings('organization serpapi result', 'organization serpapi results');
    }

    public function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'company',
            'type' => 'relationship',
            'label' => 'Company Name',
            'key' => 'name',
            'attribute' => 'name',
        ]);

        $this->crud->addColumn([
            'name' => 'knowledge_graph',
            'type' => 'array_count',
            'label' => 'Knowledge Graph Data',
        ]);

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'reviewed',
            'label' => 'Reviewed',
        ],
            false,
            function () {
                $this->crud->addClause('reviewed');
            },
            function () {
                $this->crud->addClause('notReviewed');
            }
        );

        $this->crud->allowAccess('review');
        $this->crud->addButtonFromView('line', 'review', 'import.company.review_serpapi', 'beginning');
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsReviewed($id)
    {
        $serpapiData = CompanySerpapiData::findOrFail($id);
        $serpapiData->reviewed = true;
        $serpapiData->save();

        Alert::success('Serpapi data record was reviewed!')->flash();

        return redirect()->route('admin.import.company.serpapi-data.index');
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function review($id)
    {
        $serpapiData = CompanySerpapiData::findOrFail($id);
        $company = Company::findOrFail($serpapiData->company_id);
        $fieldsMapping = Company::getImportSerpapiMapping();
        $entityType = ListingRequestHelper::getEntityTypeByClass(Company::class);
        $relationValues = ListingRequestHelper::getEntityRelationValuesByType($entityType);

        return view('admin.import.company-serpapi.review_form',
            compact('serpapiData', 'company', 'fieldsMapping', 'relationValues')
        );
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reviewSubmit(Request $request, $id)
    {
        $serpapiData = CompanySerpapiData::findOrFail($id);
        $company = Company::findOrFail($serpapiData->company_id);

        $this->applyCompanyData($request, $company);

        $serpapiData->reviewed = true;
        $serpapiData->save();

        Alert::success('Company was updated with Serpapi data!')->flash();

        return redirect()->route('admin.import.company.serpapi-data.index');
    }

    private function applyCompanyData(Request $request, Company $company)
    {
        $fieldsMapping = $company::getImportSerpapiMapping();
        $relationData = [];

        foreach ($fieldsMapping as $field => $options) {
            $inputData = $request->input($field);

            if ($options['type'] === FieldsMapping::TYPE_RELATION) {
                $relationData[$field] = $inputData;
            } else {
                $company->{$field} = $inputData;
            }
        }

        $company->save();
        $this->applyRelationData($company, $relationData);
    }

    /**
     * @param  array  $relationsData
     */
    private function applyRelationData(Company $company, $relationData)
    {
        $fieldsMapping = Company::getImportSerpapiMapping();
        $companyUpdated = false;

        foreach ($relationData as $key => $data) {
            $options = $fieldsMapping[$key];

            if ($options['relation'] === FieldsMapping::RELATION_N_N) {
                $company->{$key}()->sync($data);
                $companyUpdated = true;
            }
        }

        if ($companyUpdated) {
            $company->touch();
        }
    }
}
