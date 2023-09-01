<?php

namespace App\Http\Livewire\Admin\Import\ClinicalTrials;

use App\Models\Clinicaltrial;
use App\Models\Focus;
use App\Models\ImportedEntity;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class Import extends Component
{
    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;
    public ?string $intervention = null;

    public string $queryUrl = 'https://clinicaltrials.gov/api/v2/studies';

    public array $queryParams = [
        'pageSize' => 50,
        'query.intr' => null,
        'query.term' => null,
        'pageToken' => null
    ];

    public array $results = [];

    private function buildQueryUrl(): string
    {
        $url = $this->queryUrl;
        $count = 0;

        foreach ($this->queryParams as $param => $value) {
            $count++;

            if ($value !== null) {
                if ($count === 1) {
                    $url .= '?' . $param . '=' . $value;
                } else {
                    $url .= '&' . $param . '=' . $value;
                }
            }
        }

        return $url;
    }

    public function rules() {
        return [
            'search' => 'required_without:intervention',
            'intervention' => 'required_without:search'
        ];
    }

    public function submit() {
        $this->validate();

        if ($this->intervention) {
            $this->queryParams['query.intr'] = $this->intervention;
        } else {
            $this->queryParams['query.term'] = $this->search;
        }

        $this->getApiResults($this->buildQueryUrl());
    }

    public function getNextPage() {
        $this->getApiResults($this->buildQueryUrl());
    }

    private function getApiResults($url) {
        try {
            $request = Http::get($url);
            $response = json_decode($request->body(), true);

            $this->results = $response['studies'];

            if (array_key_exists('nextPageToken', $response)) {
                $this->queryParams['pageToken'] = $response['nextPageToken'];
            } else {
                $this->queryParams['pageToken'] = null;
            }

            foreach ($response['studies'] as $result) {
                $attributes = [
                    'importable_type' => Clinicaltrial::class,
                    'status' => 'New',
                    'data' => $result
                ];

                ImportedEntity::updateOrCreate(
                    [
                        'name' => $result['protocolSection']['identificationModule']['nctId'],
                        'importable_type' => Clinicaltrial::class
                    ],
                    $attributes
                );
            }
        } catch(Throwable $exception) {
            // TODO: Need log & Slack notification
            dd($exception->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.import.clinical-trials.import', [
            'interventionOptions' => Focus::drugs()->get()
        ]);
    }
}
