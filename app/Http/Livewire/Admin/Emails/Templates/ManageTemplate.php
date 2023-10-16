<?php

namespace App\Http\Livewire\Admin\Emails\Templates;

use App\Models\EmailTemplate;
use Livewire\Component;

class ManageTemplate extends Component
{
    public EmailTemplate $template;

    protected $rules = [
        'template.subject' => 'required',
        'template.body' => 'required',
    ];

    public function submit()
    {
        $this->validate();
        $this->template->save();
        $this->dispatchBrowserEvent('toast-notification',  ['text' => 'Template saved!', 'background' => 'bg-success']);
    }

    public function render()
    {
        return view('livewire.admin.emails.templates.manage-template');
    }
}
