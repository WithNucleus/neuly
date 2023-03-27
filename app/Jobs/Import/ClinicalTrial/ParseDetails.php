<?php

namespace App\Jobs\Import\ClinicalTrial;

use App\Models\Clinicaltrial;
use App\Models\ClinicaltrialParsingResult;
use DOMDocument;
use DOMXPath;
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

    private $clinicaltrial;

    private $attributesToRemove;

    /**
     * Parse Details constructor.
     */
    public function __construct(Clinicaltrial $clinicaltrial)
    {
        $this->clinicaltrial = $clinicaltrial;

        $this->attributesToRemove = [
            'class',
            'style',
            'lang',
            'width',
            'height',
            'align',
            'hspace',
            'vspace',
            'dir',
        ];
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

            $brief_summary = $baseNode->filter('.ct-body3.tr-indent2')
                ->first()
                ->html($defaultValue);

            $detailedDescription = $baseNode->filter('#COLLAPSE-DetailedDesc .ct-body3.tr-indent2')
                ->first()
                ->html($defaultValue);

            $parsingResult->brief_summary = $this->stripAttributes($brief_summary, $this->attributesToRemove);
            $parsingResult->detailed_description = $this->stripAttributes($detailedDescription, $this->attributesToRemove);
        } catch (\Exception $e) {
            Log::error("An error occurred while trying to parse the Clinical trial url: '$url' . Error message: ".$e->getMessage());
        }

        $parsingResult->save();
    }

    /**
     * Strip Attributes from HTML Strings
     *
     * @return false|string
     */
    private function stripAttributes($html, $attributes)
    {
        $html = '<div>'.$html.'</div>';
        $dom = new DOMDocument;
        $dom->loadHTML($html);
        $xPath = new DOMXPath($dom);

        foreach ($attributes as $attribute) {
            $nodes = $xPath->query('//*[@'.$attribute.']');
            foreach ($nodes as $node) {
                $node->removeAttribute($attribute);
            }
        }

        return substr($dom->saveHTML($dom->getElementsByTagName('div')->item(0)), 5, -6);
    }
}
