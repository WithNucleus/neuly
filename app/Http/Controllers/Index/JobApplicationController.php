<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobApplicationRequest;
use App\Models\Job;
use App\Models\JobApplication;
use Auth;

class JobApplicationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:Admin', 'permission:view job applications'])->only('getResume', 'getCoverLetter');
    }

    // Job Application Form
    public function index($slug)
    {
        // Find Job
        $job = Job::where('slug', $slug)->firstOrFail();

        // Return View
        return view('discover.jobs.apply', compact('job'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function apply(JobApplicationRequest $request)
    {
        $user = Auth::user();
        $job_id = $request->input('job_id');

        $job = Job::findOrFail($job_id);

        $resume_path = null;
        $cover_letter_path = null;
        $fullName = $user->name.'-'.$user->last_name;

        if ($request->file('resume')->isValid()) {
            $resume_filename = 'job-'.$job_id.'-'.$fullName.'-resume.pdf';
            $resume_path = $request->resume->storeAs('jobsapps', $resume_filename);
        }

        if ($request->file('cover_letter')->isValid()) {
            $cover_letter_filename = 'job-'.$job_id.'-'.$fullName.'-cover-letter.pdf';
            $cover_letter_path = $request->cover_letter->storeAs('jobsapps', $cover_letter_filename);
        }

        $attributes = [
            'user_id' => $user->id,
            'job_id' => $job_id,
            'resume' => $resume_path,
            'cover_letter' => $cover_letter_path,
        ];

        JobApplication::create($attributes);

        return view('discover.jobs.success', compact('user', 'job'));
    }

    // Get Resume
    public function getResume($id)
    {
        $job_app = JobApplication::find($id);

        $applicant = $job_app->applicantName;

        $file = storage_path().'/app/'.$job_app->resume;

        if (file_exists($file)) {
            $headers = [
                'Content-Type' => 'application/pdf',
            ];

            return response()->download($file, $job_app->job->job_title.' - '.$applicant.' Resume.pdf', $headers, 'inline');
        }
    }

    // Get Cover Letter
    public function getCoverLetter($id)
    {
        $job_app = JobApplication::find($id);

        $applicant = $job_app->applicantName;

        $file = storage_path().'/app/'.$job_app->cover_letter;

        if (file_exists($file)) {
            $headers = [
                'Content-Type' => 'application/pdf',
            ];

            return response()->download($file, $job_app->job->job_title.' - '.$applicant.' Cover Letter.pdf', $headers, 'inline');
        }
    }
}
