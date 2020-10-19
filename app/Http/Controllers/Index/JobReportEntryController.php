<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\JobReportEntry;
use App\Http\Requests\JobReportEntryRequest;
use Illuminate\Support\Facades\Session;

class JobReportEntryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $currentlyHiring      = JobReportEntry::getCurrentlyHiringValues();
        $jobListingSources    = [
            'My website',
            'LinkedIn',
            'Third-party Online Job Board',
            'Offering is not published yet, will follow up with an email',
        ];
        $mostImportantRoles   = [
            'Marketing / Media',
            'Public Relations',
            'CEO / Executive',
            'Scientific Research',
            'Therapist / Counselor',
            'Other',
        ];
        $holdingFromExpanding = [
            'Lack of qualified employees',
            'Lack of adequate job boards',
            'Capital',
            'The ongoing COVID-19 pandemic',
            'Regulatory uncertainty',
            'Other',
        ];
        $jobGrowthForecast    = [
            'Hiring will decrease',
            'Job growth will remain stagnant',
            'Hiring will increase',
            'Other',
        ];

        return view('discover.job-report-entries.index', compact(
            'currentlyHiring',
            'jobListingSources',
            'mostImportantRoles',
            'holdingFromExpanding',
            'jobGrowthForecast'
        ));
    }

    /**
     * @param \App\Http\Requests\JobReportEntryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(JobReportEntryRequest $request)
    {

        $data = [
            'name'             => $request->input('name'),
            'email'            => $request->input('email'),
            'company'          => $request->input('company'),
            'position'         => $request->input('position'),
            'currently_hiring' => $request->input('currently_hiring'),
        ];

        if ($data['currently_hiring'] == JobReportEntry::CURRENTLY_HIRING_YES) {
            $data['job_listing_src'] = $request->input('job_listing_src');
            $data['job_listing_url'] = $request->input('job_listing_url');
        }

        $data['most_important_role']    = $request->input('most_important_role_other') ?: $request->input('most_important_role');
        $data['holding_from_expanding'] = $request->input('holding_from_expanding_other') ?: $request->input('holding_from_expanding');
        $data['job_growth_forecast']    = $request->input('job_growth_forecast_other') ?: $request->input('job_growth_forecast');

        $jobReportEntry = new JobReportEntry();
        $jobReportEntry->fill($data);
        $jobReportEntry->save();

        Session::flash('success', 'Thank you, information saved successfully!');

        return redirect()->route('job-report-entry.index');
    }
}
