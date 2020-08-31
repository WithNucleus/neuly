<?php

namespace App\Models;

use App\Helpers\EntityMergeHelper;
use App\Models\Contracts\EntityContract;
use App\Models\Traits\OldSlugRedirectable;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Focus extends Model implements EntityContract
{
    use CrudTrait;
    use HasFollowers;
    use OldSlugRedirectable;
    use LogsActivity;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'focus';
    protected $guarded = ['id'];

    // log activity for all attributes, which not listed in $guarded array
    protected static $logUnguarded = true;
    protected static $logName = 'entities';

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

    // Each Focus Can Have Multiple Companies
    public function companies() {
        return $this->belongsToMany('App\Models\Company', 'company_focus', 'focus_id', 'company_id')->withTimestamps();
    }

    // Each Focus Can Have Multiple Investors
    public function investors() {
        return $this->belongsToMany('App\Models\Investor', 'focus_investor', 'focus_id', 'investor_id')->withTimestamps();
    }

    // Each Focus Can Have Multiple Research Items
    public function research() {
        return $this->belongsToMany('App\Models\Research', 'focus_research', 'focus_id', 'research_id')->withTimestamps();
    }

    // Each Focus Can Have Multiple Jobs
    public function jobs() {
        return $this->belongsToMany('App\Models\Job', 'focus_job', 'focus_id', 'job_id')->withTimestamps();
    }

    // Each Focus Can Have Multiple Events
    public function events() {
        return $this->belongsToMany('App\Models\Event', 'event_focus', 'focus_id', 'event_id')->withTimestamps();
    }

    // Each Focus Can Have Multiple News Articles
    public function newsarticles() {
        return $this->belongsToMany('App\Models\NewsArticle', 'focus_news_article', 'focus_id', 'news_article_id')->withTimestamps();
    }

    // Each Focus Can Have Multiple Clinical Trials
    public function clinicaltrials() {
        return $this->belongsToMany('App\Models\Clinicaltrial', 'clinicaltrial_focus', 'focus_id', 'clinicaltrial_id')->withTimestamps();
    }

    // Each Focus Can Have Multiple Import Results
    public function importResults() {
        return $this->hasMany('App\Models\ImportResult');
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

    public function getShowLink() {
        return '<a href="' . route('discover.focus.show', $this->slug) . '">' . $this->name . '</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setNameAttribute($value) {

        $this->attributes['name'] = $value;

        $this->attributes['slug'] = Str::slug($value);

    }

    /**
     * @return array
     */
    public static function getMergeMapping()
    {
        return [
            //attributes
            'name'           => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'slug'           => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            //relations
            'companies'      => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'name',
            ],
            'investors'      => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'name',
            ],
            'research'       => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'name',
            ],
            'jobs'           => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'job_title',
            ],
            'events'         => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'name',
            ],
            'newsarticles'   => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'name',
                'label'         => 'News Articles'
            ],
            'clinicaltrials' => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'title',
            ],
        ];
    }
}
