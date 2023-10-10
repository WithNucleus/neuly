<?php

namespace App\Http\Controllers\Adminx\Emails;

use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Models\EmailJourney;
use App\Models\EmailPreference;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\View;

class EmailController extends Controller
{
    public function __construct() {
        View::share('currentRoute', 'emails');
    }

    public function emails(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.emails.emails.index');
    }

    public function templates(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.emails.templates.index');
    }

    public function journeys(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.emails.journeys.index');
    }

    public function triggers(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.emails.triggers.index');
    }

    public function preferences(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.emails.preferences.index');
    }

    public function journeyShow($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $journey = EmailJourney::findOrFail($id);
        return view('adminx.emails.journeys.show', [
            'journey' => $journey
        ]);
    }

    public function templateShow($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $template = EmailTemplate::findOrFail($id);
        return view('adminx.emails.templates.show', [
            'template' => $template
        ]);
    }

    public function emailShow($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $email = Email::findOrFail($id);
        return view('adminx.emails.emails.show', [
            'email' => $email
        ]);
    }

    public function preferenceShow($email): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $preference = EmailPreference::with(['user', 'emails'])->findOrFail($email);
        return view('adminx.emails.preferences.show', [
            'preference' => $preference
        ]);
    }
}
