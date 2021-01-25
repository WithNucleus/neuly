<?php

namespace App\Jobs\Import\ClinicalTrial;

use App\Models\Clinicaltrial;
use App\Models\ClinicaltrialParsingResult;
use Goutte\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ParseDetails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $baseUrl = 'https://clinicaltrials.gov/ct2/show/';

    /**
     * @var \App\Models\Clinicaltrial
     */
    private $clinicaltrial;

    /**
     * ProcessLocation constructor.
     * @param \App\Models\Clinicaltrial $clinicaltrial
     * @param \App\Models\ImportResult $importResult
     * @param array $locations
     */
    public function __construct(Clinicaltrial $clinicaltrial)
    {
        $this->clinicaltrial = $clinicaltrial;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $parsingResult = new ClinicaltrialParsingResult();
        $parsingResult->clinicaltrial_id = $this->clinicaltrial->id;

        try {
            $defaultValue = 'Not applicable';
            $url = $this->baseUrl.$this->clinicaltrial->nct_number;
            $crawler = (new Client())->request('GET', $url);

            $baseNode = $crawler->filter('#tab-body > div.tr-indent2 > div.tr-indent1 > div.tr-indent2');
            $parsingResult->brief_summary = $baseNode->filter('.ct-body3.tr-indent2')
                ->first()
                ->text($defaultValue, true);
            $parsingResult->detailed_description = $baseNode->filter('#COLLAPSE-DetailedDesc .ct-body3.tr-indent2')
                ->first()
                ->text($defaultValue, true);
        } catch (\Exception $e) {
            Log::error("An error occurred while trying to parse the Clinical trial url: '$url' . Error message: ".$e->getMessage());
        }

        $parsingResult->save();
    }
}
