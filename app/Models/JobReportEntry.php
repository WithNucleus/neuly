<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class JobReportEntry extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    const CURRENTLY_HIRING_NO = 0;
    const CURRENTLY_HIRING_YES = 1;
    const CURRENTLY_HIRING_PLANNED = 2;

    protected $table = 'job_report_entries';
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'email',
        'company',
        'position',
        'currently_hiring',
        'job_listing_src',
        'job_listing_url',
        'most_important_role',
        'holding_from_expanding',
        'job_growth_forecast',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public static function getCurrentlyHiringValues()
    {
        return [
            self::CURRENTLY_HIRING_NO => 'No',
            self::CURRENTLY_HIRING_YES => 'Yes',
            self::CURRENTLY_HIRING_PLANNED => 'Not currently, but we plan on doing so in the next 6-12 months',
        ];
    }

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
