<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Company;
use App\Models\JobApplication;
use App\Http\Requests\JobApplicationRequest;
use Auth;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobApplicationNotification;
use Illuminate\Support\Facades\Storage;

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
        // $this->middleware('neuly.membership');
        $this->middleware(['role:Admin','permission:view job applications'])->only('getResume', 'getCoverLetter');
    }

    // Job Application Form
    public function index($slug) {

    	// Find Job
    	$job = Job::where('slug', $slug)->firstOrFail();

    	// Return View
    	return view('discover.jobs.apply', compact('job'));

    }

    // Process Job Application
    public function apply(JobApplicationRequest $request) {

    	// Get Job ID
    	$job_id = $request->input('job_id');

    	// Get User ID
    	$user_id = Auth::id();

    	// Get User's Name
    	$name = User::find($user_id)->name;

    	// Get Company ID
    	$company_id = $request->input('company_id');

    	// Get Company Name
    	$company = Company::find($company_id)->name;

    	// Get Job Position
    	$position = Job::find($job_id)->job_title;

    	// Check if Valid
    	if ($request->file('resume')->isValid() AND $request->file('cover_letter')->isValid()) {

			// Store Resume
			$resume = $request->file('resume');
			$resume_filename = 'job-' . $job_id . '-' . $name . '-resume.pdf';
			$resume_path = $request->resume->storeAs('jobsapps' , $resume_filename);

			// Store Cover Letter
			$cover_letter = $request->file('cover_letter');
			$cover_letter_filename = 'job-' . $job_id . '-' . $name . '-cover-letter.pdf';
			$cover_letter_path = $request->cover_letter->storeAs('jobsapps' , $cover_letter_filename);

		}

		// Job Application Attributes
		$attributes = array(
			'user_id' => $user_id,
			'job_id' => $job_id,
			'company_id' => $company_id,
			'resume' => $resume_path,
			'cover_letter' => $cover_letter_path
		);

		// Create Job Application Record
		$job_application = JobApplication::create($attributes);

		// Send Mail to Cody
		Mail::to('support@neuly.com')
				->bcc('sydney@gotsmith.com')
				->send(new JobApplicationNotification($job_id, $name, $company, $position, $resume_path, $cover_letter_path));

		// Return Success View
		return view('discover.jobs.success', compact('name', 'company', 'position'));

    }

    // Get Resume
    public function getResume($id) {

        $job_app = JobApplication::find($id);

        $applicant = $job_app->getApplicantName();

        $file = storage_path() . '/app/' . $job_app->resume;

        if (file_exists($file)) {

            $headers = [
                'Content-Type' => 'application/pdf'
            ];

            return response()->download($file, $job_app->job->job_title . ' - ' . $applicant . ' Resume.pdf', $headers, 'inline');

        }

    }

    // Get Cover Letter
    public function getCoverLetter($id) {

        $job_app = JobApplication::find($id);

        $applicant = $job_app->getApplicantName();

        $file = storage_path() . '/app/' . $job_app->cover_letter;

        if (file_exists($file)) {

            $headers = [
                'Content-Type' => 'application/pdf'
            ];

            return response()->download($file, $job_app->job->job_title . ' - ' . $applicant . ' Cover Letter.pdf', $headers, 'inline');

        }

    }
}
