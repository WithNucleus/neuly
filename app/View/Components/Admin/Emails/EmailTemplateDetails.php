<?php

namespace App\View\Components\Admin\Emails;

use App\Models\EmailTemplate;
use Illuminate\View\Component;

class EmailTemplateDetails extends Component
{
    public EmailTemplate $emailTemplate;
    public bool $showTemplateLink;

    public function __construct(EmailTemplate $emailTemplate, bool $showTemplateLink = false)
    {
        $this->emailTemplate = $emailTemplate;
        $this->showTemplateLink = $showTemplateLink;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|\Closure|string|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.admin.emails.email-template-details');
    }
}
