<?php

namespace App\Models;

use App\Helpers\Entity\FieldsMapping;
use App\Models\Contracts\EntityContract;
use App\Models\Traits\CrudShowEntityPageButton;
use App\Models\Traits\OldSlugRedirectable;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Focus extends Model implements EntityContract
{
    use CrudTrait;
    use HasFollowers;
    use OldSlugRedirectable;
    use LogsActivity;
    use CrudShowEntityPageButton;

    const TYPE_DRUG = 'drug';

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
    public function clinicaltrials()
    {
        return $this->belongsToMany('App\Models\Clinicaltrial', 'clinicaltrial_focus', 'focus_id', 'clinicaltrial_id')->withTimestamps();
    }

    public function companies()
    {
        return $this->belongsToMany('App\Models\Company', 'company_focus', 'focus_id', 'company_id')->withTimestamps();
    }

    public function events()
    {
        return $this->belongsToMany('App\Models\Event', 'event_focus', 'focus_id', 'event_id')->withTimestamps();
    }

    public function importResults()
    {
        return $this->hasMany('App\Models\ImportResult');
    }

    public function jobs()
    {
        return $this->belongsToMany('App\Models\Job', 'focus_job', 'focus_id', 'job_id')->withTimestamps();
    }

    public function newsarticles()
    {
        return $this->belongsToMany('App\Models\NewsArticle', 'focus_news_article', 'focus_id', 'news_article_id')->withTimestamps();
    }

    public function people()
    {
        return $this->belongsToMany(Person::class, 'focus_person', 'focus_id', 'person_id');
    }

    public function research()
    {
        return $this->belongsToMany('App\Models\Research', 'focus_research', 'focus_id', 'research_id')->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /**
     * @param $query
     * @return mixed
     */
    public function scopeDrugs($query)
    {
        return $query->where('type', self::TYPE_DRUG);
    }

    public function scopeHasCompanies($query)
    {
        return $query->whereHas('companies');
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeHasJobs($query)
    {
        return $query->whereHas('jobs');
    }

    public function scopeHasClinicaltrials($query)
    {
        return $query->whereHas('clinicaltrials');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getShowLink()
    {
        return '<a href="'.route('discover.focus.show', $this->slug).'">'.$this->name.'</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * @return array
     */
    public static function getFieldsMapping()
    {
        return [
            //attributes
            'name'           => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'slug'           => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            //relations
            'clinicaltrials' => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'title',
            ],
            'companies'      => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'events'         => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'investors'      => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'jobs'           => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'job_title',
            ],
            'newsarticles'   => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
                'label'         => 'News Articles',
            ],
            'people'       => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'research'       => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
        ];
    }
}
