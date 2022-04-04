<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'metrics';
    protected $guarded = ['id'];
    protected $dates = ['date'];

    const TYPE_COUNT = 'count';
    const TYPE_CHANGE = 'change';

    const FREQUENCY_DAILY = 'daily';
    const FREQUENCY_WEEKLY = 'weekly';
    const FREQUENCY_MONTHLY = 'monthly';
    const FREQUENCY_QUARTERLY = 'quarterly';
    const FREQUENCY_YEARLY = 'yearly';

    const METRICS_FIELDS = [
        'organizations',
        'people',
        'investors',
        'clinical_trials',
        'research',
        'locations',
        'events_total',
        'events_upcoming',
        'events_past',
        'jobs_total',
        'jobs_open',
        'jobs_archived',
        'media_items_total',
        'news',
        'articles',
        'images',
        'videos',
        'mixed_media',
        'podcasts',
        'books',
        'patent_filings',
        'courses',
        'patents',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
