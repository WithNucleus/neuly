<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Investor;
use Illuminate\Http\Request;

class InvestmentFundController extends Controller
{
    /**
     * Show the Investment Funds Chart
     *
     * @return View
     */
    public function index(Request $request)
    {
        $investors = Investor::withCount('companies')
            ->having('companies_count', '>', 0)
            ->orderBy('companies_count', 'desc');

        if ($request->has('top-ten')) {
            $investors = $investors->take(10)->get();
            $filter = 'top-ten';
        } elseif ($request->has('all')) {
            $investors = $investors->get();
            $filter = 'all';
        } else {
            $investors = $investors->take(5)->get();
            $filter = 'top-five';
        }

        $investorChart = $this->processInvestor($investors);
        $chartData = json_encode($investorChart);

        return view('discover.insights.investment-fund.index', compact('chartData', 'filter'));
    }

    /**
     * Show the Relationships Chart for an Organization
     *
     * @return View
     */
    public function organizationChart($slug)
    {
        $chartData = [];
        $filter = '';

        $company = Company::where('slug', $slug)
            ->with('investors', 'focus', 'locations', 'people', 'jobs', 'events', 'clinicaltrials')
            ->withCount('investors', 'focus', 'locations', 'people', 'jobs', 'events', 'clinicaltrials')
            ->firstOrFail();

        $companyName = $company->name;

        $companyChart = [
            'name' => $company->name,
            'value' => 10,
            'image' => $company->entityImageUrl,
            'listing_url' => route('discover.organizations.show', $company->slug),
            'chart_url' => '',
            'type' => 'company',
            'children' => [],
        ];

        if ($company->investors_count > 0) {
            $companyChart = $this->processCompanyRelationship($companyChart, $company, 'investors', 'investors_count');
        }

        if ($company->focus_count > 0) {
            $companyChart = $this->processCompanyRelationship($companyChart, $company, 'focus', 'focus_count');
        }

        if ($company->locations_count > 0) {
            $companyChart = $this->processCompanyRelationship($companyChart, $company, 'locations', 'locations_count');
        }

        if ($company->people_count > 0) {
            $companyChart = $this->processCompanyRelationship($companyChart, $company, 'people', 'people_count');
        }

        if ($company->jobs_count > 0) {
            $companyChart = $this->processCompanyRelationship($companyChart, $company, 'jobs', 'jobs_count');
        }

        if ($company->events_count > 0) {
            $companyChart = $this->processCompanyRelationship($companyChart, $company, 'events', 'events_count');
        }

        if ($company->clinicaltrials_count > 0) {
            $companyChart = $this->processCompanyRelationship($companyChart, $company, 'clinicaltrials', 'clinicaltrials_count');
        }

        array_push($chartData, $companyChart);

        $chartData = json_encode($chartData);

        return view('discover.insights.investment-fund.organization', compact('chartData', 'filter', 'companyName'));
    }

    /**
     * Process the investors and their companies
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $investors
     * @return array
     */
    private function processInvestor($investors)
    {
        $investorChart = [];
        $investorIds = $investors->pluck('id')->toArray();
        $relatedCompanies = $this->getRelatedCompanies($investorIds);

        foreach ($investors as $investor) {
            $childrenCompanies = isset($relatedCompanies[$investor->id]) ? $relatedCompanies[$investor->id] : [];
            $investorData = [
                'name' => $investor->name,
                'value' => $investor->companies_count,
                'image' => $investor->entityImageUrl,
                'type' => 'investor',
                'children' => $childrenCompanies,
            ];

            array_push($investorChart, $investorData);
        }

        return $investorChart;
    }

    /**
     * @return array
     */
    private function getRelatedCompanies($investorIds)
    {
        $companies = Company::whereHas('investors', function ($query) use ($investorIds) {
            return $query->whereIn('investors.id', $investorIds);
        })
            ->with('investors')
            ->with('focus')
            ->get();

        $companiesByInvestorId = [];

        foreach ($companies as $company) {
            $focusList = implode(' / ', $company->focus->pluck('name')->toArray());
            $companyData = [
                'name' => $company->name,
                'value' => 3,
                'image' => $company->entityImageUrl,
                'type' => 'company',
                'ownership' => $company->ownership,
                'listing_url' => route('discover.organizations.show', $company->slug),
                'chart_url' => route('insights.investment-funds.organization', $company->slug),
                'investors_count' => $company->investors->count(),
                'focus_list' => $focusList,
            ];

            $companyInvestorIds = $company->investors->pluck('id')->toArray();

            foreach ($investorIds as $investorId) {
                if (in_array($investorId, $companyInvestorIds)) {
                    $companiesByInvestorId[$investorId][] = $companyData;
                }
            }
        }

        return $companiesByInvestorId;
    }

    private function processCompanyRelationship($companyChart, $company, $model, $model_count)
    {
        $value = ceil($company->{$model_count} / 10);

        $companyData = [
            'name' => ucwords($model),
            'value' => $value,
            'image' => asset('images/icons/small-transparent/'.$model.'.svg'),
            'listing_url' => '',
            'chart_url' => '',
            'type' => $model,
            'children' => [],
        ];

        foreach ($company->{$model} as $entity) {
            $modelData = [
                'name' => $entity->name,
                'value' => 1,
                'listing_url' => route('discover.'.$model.'.show', $entity->slug),
                'chart_url' => '',
                'type' => $model,
                'image' => asset('images/icons/small-transparent/'.$model.'.svg'),
            ];

            if ($model == 'events' or $model == 'investors') {
                $modelData['image'] = $entity->entityImageUrl;
            }

            array_push($companyData['children'], $modelData);
        }

        array_push($companyChart['children'], $companyData);

        return $companyChart;
    }
}
