<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Investor;

class InvestmentFundController extends Controller
{

    /**
     * Show the Investment Funds Chart
     * @param Request $request
     * @return View
     */
    public function index(Request $request) {

        $investors = Investor::has('companies')->withCount('companies')->orderBy('companies_count', 'desc')->with('companies');

        $companiesList = $this->getCompanies();

        if ($request->has('top-ten')) {
            $investors = $investors->take(10)->get();
            $filter = 'top-ten';
        } elseif($request->has('all')) {
            $investors = $investors->get();
            $filter = 'all';
        } else {
            $investors = $investors->take(5)->get();
            $filter = 'top-five';
        }

        $investorData = $this->processInvestor($investors, $companiesList);

        $chartData = json_encode($investorData);

        return view('discover.insights.investment-fund.index', compact('chartData', 'filter'));
    }

    /**
     * Process the investors and their companies
     * @param $investors
     * @param $companiesList
     * @return array
     */
    private function processInvestor($investors, $companiesList) {

        $investorData = [];

        foreach ($investors as $investor) {

            $thisInvestor = [
                'name' => $investor->name,
                'value' => $investor->companies_count,
                'image' => $investor->entityImageUrl,
                'type' => 'investor'
            ];

            if ($investor->companies_count > 0) {

                $thisInvestor['children'] = [];

                foreach ($investor->companies as $company) {

                    $thisCompany = [
                        'name' => $company->name,
                        'value' => 3,
                        'image' => $company->entityImageUrl,
                        'type' => 'company',
                        'ownership' => $company->ownership,
                        'url' => route('discover.organizations.show', $company->slug),
                        'investors_count' => $companiesList[$company->name]['investors'],
                        'focus_list' => $companiesList[$company->name]['focus']
                    ];

                    array_push($thisInvestor['children'], $thisCompany);
                }

            }

            array_push($investorData, $thisInvestor);
        }

        return $investorData;

    }

    /**
     * Get all Companies who have Investors
     * @return array
     */
    private function getCompanies() {

        $companies = Company::has('investors')->with('focus')->withCount('investors')->get();

        $companiesList = [];

        foreach ($companies as $company) {

            $focusList = '';

            foreach ($company->focus as $focus) {
                $focusList .= $focus->name . ' / ';
            }

            $focusList = rtrim($focusList, ' / ');

            $thisCompany = [
                'investors' => $company->investors_count,
                'focus' => $focusList
            ];

            $companiesList[$company->name] = $thisCompany;
        }
        return $companiesList;
    }

    /**
     *
     *
     *
     */
    private function filterQuery($query, $request)
    {

    }
}
