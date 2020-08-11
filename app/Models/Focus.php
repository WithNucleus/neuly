<?php

namespace App\Models;

use App\Traits\hasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use Illuminate\Support\Str;

class Focus extends Model
{
    use CrudTrait;
    use hasFollowers;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'focus';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];

    protected $fillable = [
        'name'
    ];

    // protected $hidden = [];
    // protected $dates = [];

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

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setNameAttribute($value) {

        $this->attributes['name'] = $value;

        $this->attributes['slug'] = Str::slug($value);

    }
}
