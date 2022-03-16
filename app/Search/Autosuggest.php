<?php

namespace App\Search;

use Algolia\ScoutExtended\Searchable\Aggregator;

class Autosuggest extends Aggregator
{
    private const INDEX = 'general_query_suggestions';
    /**
     * The names of the models that should be aggregated.
     *
     * @var string[]
     */
    protected $models = [
        \App\Models\Company::class,
        \App\Models\Person::class,
        \App\Models\Investor::class,
        \App\Models\Research::class,
        \App\Models\Clinicaltrial::class,
        \App\Models\Event::class,
        \App\Models\Job::class
    ];

    public function searchableAs(): string
    {
        return config('scout.prefix').self::INDEX;
    }
}
