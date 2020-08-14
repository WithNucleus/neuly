<?php

namespace App\Http\Controllers\Admin\Import;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Models\ImportSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:Admin', 'permission:import']);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // ImportSettings always stored with ID = 1
        $importSettings = ImportSetting::find(1);

        return view('admin.import.settings', compact('importSettings'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // ImportSettings always stored with ID = 1
        $importSettings              = ImportSetting::find(1);
        $mappingOrganisation         = strtolower($request->input('mapping_organisation'));
        $mappingOrganisationFiltered = StringHelper::explodeAndFilterEmpty($mappingOrganisation, ',');

        if ($importSettings) {
            $importSettings->mapping_organisation = $mappingOrganisationFiltered;
            $importSettings->update();
        } else {
            $importSettings                       = new ImportSetting();
            $importSettings->id                   = 1;
            $importSettings->mapping_organisation = $mappingOrganisationFiltered;
            $importSettings->save();
        }

        Session::flash('success', 'Your settings have been saved successfully.');

        return redirect()->route('import.settings.index');
    }

}
