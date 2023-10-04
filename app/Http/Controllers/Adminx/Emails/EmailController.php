<?php

namespace App\Http\Controllers\Adminx\Emails;

use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Models\EmailCampaign;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\View;

class EmailController extends Controller
{
    public function __construct() {
        View::share('currentRoute', 'emails');
    }

    public function emails(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.emails.emails');
    }

    public function templates(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.emails.email-templates');
    }

    public function campaigns(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.emails.email-campaigns');
    }

    public function campaignShow($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $campaign = EmailCampaign::findOrFail($id);
        return view('adminx.emails.email-campaign-show', [
            'campaign' => $campaign
        ]);
    }

    public function templateShow($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $template = EmailTemplate::findOrFail($id);
        return view('adminx.emails.email-template-show', [
            'template' => $template
        ]);
    }

    public function emailShow($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $email = Email::findOrFail($id);
        return view('adminx.emails.email-show', [
            'email' => $email
        ]);
    }

    public function drips(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.emails.email-drips');
    }
}
