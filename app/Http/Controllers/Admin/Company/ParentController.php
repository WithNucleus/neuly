<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class ParentController extends Controller
{
    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id) {
        $company = Company::with(['parents', 'subsidiaries'])->findOrFail($id);
        $ignoreCompanyIds = $company->getParentsAndSubsidiariesIgnoredIds();
        $companiesList = Company::whereNotIn('id', $ignoreCompanyIds)->orderBy('name')->get();
        $types = Company::COMPANY_TO_COMPANY_TYPES;

    	return view('admin.company.parent', compact('company', 'companiesList', 'types'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $id)
    {
        $parentId = $request->input('parent_id');
        $company = Company::findOrFail($id);
        $parentCompany = Company::findOrFail($parentId);

        $company->parents()->attach($parentCompany->id, [
            'type' => $request->input('type'),
        ]);

        return redirect()->back();
    }

    /**
     * @param int $id
     * @param int $parentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id, $parentId)
    {
        $company = Company::findOrFail($id);
        $company->parents()->detach($parentId);

        return redirect()->back();
    }
}
