<?php

namespace App\Jobs\AutoTag;

use App\Models\Clinicaltrial;
use App\Models\Focus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TagClinicalTrial implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Clinicaltrial $clinicalTrial;

    public function __construct(Clinicaltrial $clinicalTrial)
    {
        $this->clinicalTrial = $clinicalTrial;
    }

    public function handle()
    {
        $drugFocuses = Focus::drugs()->get()->pluck('name', 'id')->toArray();
        $drugFocuses = array_map('strtolower', $drugFocuses);

        $focusArray = [];

        $title = strtolower($this->clinicalTrial->title);
        $summary = strtolower($this->clinicalTrial->brief_summary);

        $interventions = $this->clinicalTrial->interventions;

        foreach ($drugFocuses as $focusId => $focus) {
            if (preg_match("/\b" . $focus . "\b/i", $title)) {
                $focusArray[] = $focusId;
            }
        }

        foreach ($drugFocuses as $focusId => $focus) {
            if (preg_match("/\b" . $focus . "\b/i", $summary)) {
                $focusArray[] = $focusId;
            }
        }

        foreach($interventions as $intervention) {

            $value = strtolower($intervention->value);

            foreach ($drugFocuses as $focusId => $focus) {
                if (preg_match("/\b" . $focus . "\b/i", $value)) {
                    $focusArray[] = $focusId;
                }
            }
        }

        $focuses = array_unique($focusArray);
        $this->clinicalTrial->focus()->syncWithoutDetaching($focuses);
    }
}
