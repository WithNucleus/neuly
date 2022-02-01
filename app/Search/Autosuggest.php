<?php

namespace App\Search;

use Algolia\ScoutExtended\Searchable\Aggregator;

class Autosuggest extends Aggregator
{
    private const INDEX_NAME = 'general_query_suggestions';
    /**
     * The names of the models that should be aggregated.
     *
     * @var string[]
     */
    protected $models = [
        \App\Models\Company::class,
        \App\Models\People::class,
        \App\Models\Investor::class,
        \App\Models\Research::class,
        \App\Models\Cliicaltrial::class,
        \App\Models\Event::class,
        \App\Models\Job::class
    ];

    public function searchableAs(): string
    {
        return config('scout.prefix').$this->INDEX_NAME;
    }
}
