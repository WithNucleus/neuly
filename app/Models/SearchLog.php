<?php

namespace App\Models;

use App\User;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $table = 'search_log';

    protected $guarded = ['id'];
    protected $casts = [
        'data' => 'array'
    ];

    const TYPE_SEARCH = 'Search';
    const TYPE_NEULY_CARE = 'Neuly Care';
    const TYPE_RECRUITING_TRIALS_ELIGIBILITY = 'Recruiting Trial Eligibility';
    const TYPE_RECRUITING_TRIALS = 'Recruiting Clinical Trials';
    const TYPE_RECRUITING_CONCIERGE = 'Recruiting Trials Concierge';
    const TYPE_NEULY_EDU_COURSES = 'Neuly EDU Courses';
    const TYPE_CARE_BOOK_LISTING = 'Bookable Listing Request';
    const TYPE_JOB_APPLY_LINK = 'Job Application Link';

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
    /* RELATIONSHIPS */
    public function location(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function relatable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

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
    public function getEntityShowLinkAttribute() {

    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
