<?php

namespace App\Jobs\Import\Company;

use App\Models\Company;
use App\Models\CompanySerpapiData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SerpapiData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $company;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $serpapiData = new CompanySerpapiData;
        $serpapiData->company_id = $this->company->id;

        try {
            // TODO: GoogleSearch package does not support PHP 8 yet
//            $apiKey = config('services.serpapi.private_api_key');
//            $search = new \GoogleSearch($apiKey);
//            $query = [
//                'q' => $this->company->name,
//            ];
//            $result = $search->get_json($query);
//
//            if (isset($result->knowledge_graph)) {
//                $serpapiData->knowledge_graph = $result->knowledge_graph;
//            }
//
//            $serpapiData->save();
        } catch (\Exception $e) {
            Log::error("An error occurred while trying to get SerpApi data for company: '".$this->company->name."' . Error message: ".$e->getMessage());
        }
    }
}
