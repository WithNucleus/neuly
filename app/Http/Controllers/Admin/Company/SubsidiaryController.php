<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class SubsidiaryController extends Controller
{
    /**
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $company = Company::with(['parents', 'subsidiaries'])->findOrFail($id);
        $ignoreCompanyIds = $company->getParentsAndSubsidiariesIgnoredIds();
        $companiesList = Company::whereNotIn('id', $ignoreCompanyIds)->orderBy('name')->get();
        $types = Company::COMPANY_TO_COMPANY_TYPES;

        return view('admin.company.subsidiary', compact('company', 'companiesList', 'types'));
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $id)
    {
        $subsidiaryId = $request->input('subsidiary_id');
        $company = Company::findOrFail($id);
        $subsidiaryCompany = Company::findOrFail($subsidiaryId);

        $company->subsidiaries()->attach($subsidiaryCompany->id, [
            'type' => $request->input('type'),
        ]);
        $company->touch();

        return redirect()->back();
    }

    /**
     * @param  int  $id
     * @param  int  $parentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id, $subsidiaryId)
    {
        $company = Company::findOrFail($id);
        $company->subsidiaries()->detach($subsidiaryId);
        $company->touch();

        return redirect()->back();
    }
}
