<?php

namespace App\Http\Controllers\Admin\Import;

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
        // Auth and Permission Middleware
        $this->middleware('auth');
        $this->middleware(['role:Admin', 'permission:import']);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //there is always single record in ImportSetting
        $importSettings = ImportSetting::where('id', 1)->first();

        return view('admin.import.settings', compact('importSettings'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        //there is always single record in ImportSetting
        $importSettings              = ImportSetting::where('id', 1)->first();
        $mappingOrganisation         = explode(',', strtolower($request->mapping_organisation));
        $mappingOrganisationFiltered = array_filter(array_map('trim', $mappingOrganisation));

        if ($importSettings) {
            //if ImportSetting aready exist - update
            $importSettings->mapping_organisation = $mappingOrganisationFiltered;
            $importSettings->update();
        } else {
            //if ImportSetting not exist - create
            $importSettings                       = new ImportSetting();
            $importSettings->id                   = 1;
            $importSettings->mapping_organisation = $mappingOrganisationFiltered;
            $importSettings->save();
        }

        Session::flash('success', 'Your settings have been saved successfully.');

        return redirect()->route('import.settings.index');
    }

}
