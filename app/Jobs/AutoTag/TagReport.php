<?php

namespace App\Jobs\AutoTag;

use App\Models\Focus;
use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TagReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Report $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function handle()
    {
        $this->focusTags();
    }

    private function focusTags() {
        $drugFocuses = Focus::drugs()->get()->pluck('name', 'id')->toArray();
        $drugFocuses = array_map('strtolower', $drugFocuses);

        if ($this->report->excerpt != '') {
            $content = strtolower($this->report->excerpt);

            foreach ($drugFocuses as $focusId => $focus) {
                if (preg_match("/\b" . $focus . "\b/i", $content)) {
                    $this->report->focus()->syncWithoutDetaching([$focusId]);
                }
            }
        }

        if ($this->report->content != '') {
            $content = strtolower($this->report->content);

            foreach ($drugFocuses as $focusId => $focus) {
                if (preg_match("/\b" . $focus . "\b/i", $content)) {
                    $this->report->focus()->syncWithoutDetaching([$focusId]);
                }
            }
        }
    }
}
