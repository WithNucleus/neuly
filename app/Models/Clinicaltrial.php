<?php

namespace App\Models;

use App\Helpers\Entity\FieldsMapping;
use App\Models\ClinicalTrialDetails\CtCondition;
use App\Models\ClinicalTrialDetails\CtIntervention;
use App\Models\ClinicalTrialDetails\CtOutcomeMeasure;
use App\Models\ClinicalTrialDetails\CtStudyDesign;
use App\Models\Contracts\EntityContract;
use App\Models\Traits\CrudShowEntityPageButton;
use App\Models\Traits\OldSlugRedirectable;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Clinicaltrial extends Model implements EntityContract
{
    use CrudTrait;
    use HasFollowers;
    use OldSlugRedirectable;
    use LogsActivity;
    use CrudShowEntityPageButton;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'clinicaltrials';
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

    public function locations() {
        return $this->belongsToMany('App\Models\Location', 'clinicaltrial_location', 'clinicaltrial_id', 'location_id')
                    ->withTimestamps();
    }

    public function companies() {
        return $this->belongsToMany('App\Models\Company', 'clinicaltrial_company', 'clinicaltrial_id', 'company_id')
                    ->withTimestamps();
    }

    public function people() {
        return $this->belongsToMany('App\Models\Person', 'clinicaltrial_person', 'clinicaltrial_id', 'person_id')
                    ->withTimestamps();
    }

    public function focus() {
        return $this->belongsToMany('App\Models\Focus', 'clinicaltrial_focus', 'clinicaltrial_id', 'focus_id')
                    ->withTimestamps();
    }

    public function conditions()
    {
        return $this->belongsToMany(CtCondition::class, 'clinicaltrial_condition');
    }

    public function interventions()
    {
        return $this->belongsToMany(CtIntervention::class, 'clinicaltrial_intervention');
    }

    public function outcomeMeasures()
    {
        return $this->belongsToMany(CtOutcomeMeasure::class, 'clinicaltrial_outcome_measure');
    }

    public function studyDesigns()
    {
        return $this->belongsToMany(CtStudyDesign::class, 'clinicaltrial_study_design');
    }

    public function parsingResult()
    {
        return $this->hasOne(ClinicaltrialParsingResult::class);
    }

    /**
     * Get all Sponsors and Collaborators combined together.
     *
     * @return Collection
     */
    public function sponsorsAndCollaborators()
    {
        return collect()
            ->merge($this->companies)
            ->merge($this->people)
            ->sortBy('name');
    }

    public function phase() {
        return $this->hasMany('App\Models\ClinicaltrialPhase', 'phases');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeAvailableForParsing($query)
    {
        return $query
            ->doesntHave('parsingResult')
            ->where(function (Builder $query) {
                return $query
                    ->whereNull('brief_summary')
                    ->orWhereNull('detailed_description');
            });
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

    //alias for title
    public function getNameAttribute()
    {
        return $this->attributes['title'];
    }

    // Set Slug Attribute When Setting Title
    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $nct_number = $this->attributes['nct_number'];
        $this->attributes['slug'] = $nct_number . '-' . Str::slug($value);
    }

    public function setConditionsAttribute($value) {
        $this->attributes['conditions'] = str_replace('|', ';', $value);
    }

    public function setInterventionsAttribute($value) {
        $this->attributes['interventions'] = str_replace('|', ';', $value);
    }

    /**
     * @return array
     */
    public static function getFieldsMapping()
    {
        return [
            //attributes
            'title'                   => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'slug'                    => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'nct_number'              => [
                'type'  => FieldsMapping::TYPE_STRING,
                'label' => 'NCT Number',
            ],
            'acronym'                 => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'status'                  => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'study_results'           => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'gender'                  => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'age'                     => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'phases'                  => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'enrollment'              => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'funded_bys'              => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'study_type'              => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'other_ids'               => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'start_date'              => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'primary_completion_date' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'completion_date'         => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'first_posted'            => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'results_first_posted'    => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'last_update_posted'      => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'study_url'               => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            //relations
            'companies'               => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'locations'               => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'people'                  => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'focus'                   => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'conditions'              => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_ONE_N,
                'relationField' => 'value',
            ],
            'interventions'           => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_ONE_N,
                'relationField' => 'value',
            ],
            'outcomeMeasures'        => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_ONE_N,
                'relationField' => 'value',
                'label'         => 'Outcome Measures',
            ],
            'studyDesigns'           => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_ONE_N,
                'relationField' => 'value',
                'label'         => 'Study Designs',
            ],
        ];
    }
}
