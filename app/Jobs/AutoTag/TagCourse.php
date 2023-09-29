<?php

namespace App\Jobs\AutoTag;

use App\Models\Course;
use App\Models\Focus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TagCourse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Course $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function handle()
    {
        $this->focusTags();
    }

    private function focusTags() {
        $drugFocuses = Focus::drugs()->get()->pluck('name', 'id')->toArray();
        $drugFocuses = array_map('strtolower', $drugFocuses);

        if ($this->course->summary != '') {
            $summary = strtolower($this->course->summary);

            foreach ($drugFocuses as $focusId => $focus) {
                if (preg_match("/\b" . $focus . "\b/i", $summary)) {
                    $this->course->focus()->syncWithoutDetaching([$focusId]);
                }
            }
        }
    }
}
