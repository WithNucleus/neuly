<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ClinicalTrialCollaboratorsListController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->has('orderBy') ? $request->input('orderBy') : 'desc';

        $query = DB::table('companies')
            ->join('clinicaltrial_company', 'companies.id', 'clinicaltrial_company.company_id')
            ->select('companies.id as id', 'name', 'slug', DB::raw('count(clinicaltrial_company.company_id) as trials'));

        $query = $this->filterQuery($query, $request);

        $query = $query->groupBy('clinicaltrial_company.company_id')
            ->orderBy('trials', $orderBy);

        $collaboratorList = $query->get();

        return response($collaboratorList, Response::HTTP_OK);
    }

    private function filterQuery($query, $request)
    {
        if($request->has('focus'))
        {
            $query = $this->filterByFocus($query, $request->input('focus'));
        }

        return $query;
    }

    private function filterByFocus($query, $focus)
    {
        $trialIds = DB::table('clinicaltrial_focus')
            ->select('clinicaltrial_id')
            ->whereIn('focus_id', $focus)
            ->groupBy('clinicaltrial_id')
            ->get()->pluck('clinicaltrial_id');

        return $query->whereIn('clinicaltrial_company.clinicaltrial_id', $trialIds);
    }
}
