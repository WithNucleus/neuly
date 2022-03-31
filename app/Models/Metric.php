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

    protected $casts = [
        'date' => 'date:Y-m-d'
    ];

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

    const CHART_FIELDS = [
        'organizations' => 'Organizations',
        'people' => 'People',
        'investors' => 'Investors',
        'clinical_trials' => 'Clinical Trials',
        'research' => 'Research',
        'locations' => 'Locations',
        'events_total' => 'Events',
        'jobs_total' => 'Jobs',
        'media_items_total' => 'Media Items',
        'news' => 'News',
        'articles' => 'Articles',
        'images' => 'Images',
        'videos' => 'Videos',
        'mixed_media' => 'Mixed Media',
        'podcasts' => 'Podcasts',
        'books' => 'Books',
        'patent_filings' => 'Patent Filings',
        'courses' => 'Courses',
        'patents' => 'Patents',
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
    public function scopeChanges($query) {
        return $query->where('type', self::TYPE_CHANGE);
    }

    public function scopeCounts($query) {
        return $query->where('type', self::TYPE_COUNT);
    }

    public function scopeDaily($query) {
        return $query->where('frequency', self::FREQUENCY_DAILY);
    }

    public function scopeWeekly($query) {
        return $query->where('frequency', self::FREQUENCY_WEEKLY);
    }

    public function scopeMonthly($query) {
        return $query->where('frequency', self::FREQUENCY_MONTHLY);
    }

    public function scopeQuarterly($query) {
        return $query->where('frequency', self::FREQUENCY_QUARTERLY);
    }

    public function scopeYearly($query) {
        return $query->where('frequency', self::FREQUENCY_YEARLY);
    }

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
