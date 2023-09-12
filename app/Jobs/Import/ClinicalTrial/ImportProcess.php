<?php

namespace App\Jobs\Import\ClinicalTrial;

use App\Models\Clinicaltrial;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Clinicaltrial $clinicalTrial;

    public function __construct(Clinicaltrial $clinicalTrial)
    {
        $this->clinicalTrial = $clinicalTrial;
    }

    public function handle()
    {
        //
    }
}
