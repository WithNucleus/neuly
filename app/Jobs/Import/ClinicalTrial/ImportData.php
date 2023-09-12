<?php

namespace App\Jobs\Import\ClinicalTrial;

use App\Models\Clinicaltrial;
use App\Models\ImportedEntity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ImportData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Clinicaltrial $clinicalTrial;

    public function __construct(Clinicaltrial $clinicalTrial)
    {
        $this->clinicalTrial = $clinicalTrial;
    }

    public function handle()
    {
        $url = "https://clinicaltrials.gov/api/v2/studies/" . $this->clinicalTrial->nct_number;
        $request = Http::get($url);
        $response = json_decode($request->body(), true);

        $attributes = [
            'importable_type' => Clinicaltrial::class,
            'importable_id' => $this->clinicalTrial->id,
            'status' => 'New',
            'data' => $response
        ];

        ImportedEntity::updateOrCreate(
            [
                'name' => $response['protocolSection']['identificationModule']['nctId'],
                'importable_type' => Clinicaltrial::class
            ],
            $attributes
        );
    }
}
