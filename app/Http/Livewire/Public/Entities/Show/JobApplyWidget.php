<?php

namespace App\Http\Livewire\Public\Entities\Show;

use App\Models\Job;
use App\Models\SearchLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class JobApplyWidget extends Component
{
    public int $jobId;
    public string $url;
    public bool $external = false;

    public string $ip;
    public ?int $userId = null;

    public function mount(Request $request) {

        $job = Job::find($this->jobId);

        $this->url = $job->application_url;

        if ($job->url) {
            $this->external = true;
        }

        $this->ip = $request->getClientIp();

        if (Auth::id()) {
            $this->userId = Auth::id();
        }
    }

    public function applyLink() {

        SearchLog::create([
            'term' => 'empty',
            'type' => SearchLog::TYPE_JOB_APPLY_LINK,
            'ip' => $this->ip,
            'relatable_type' => Job::class,
            'relatable_id' => $this->jobId,
            'user_id' => $this->userId
        ]);

        $this->dispatchBrowserEvent('redirect-to-url', ['url' => $this->url]);
    }

    public function render()
    {
        return view('livewire.public.entities.show.job-apply-widget');
    }
}
