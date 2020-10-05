<?php

namespace App\Models;

use App\Helpers\EntityMergeHelper;
use App\Models\ClinicalTrialDetails\CtCondition;
use App\Models\ClinicalTrialDetails\CtIntervention;
use App\Models\ClinicalTrialDetails\CtOutcomeMeasure;
use App\Models\ClinicalTrialDetails\CtStudyDesign;
use App\Models\Contracts\EntityContract;
use App\Models\Traits\OldSlugRedirectable;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Clinicaltrial extends Model implements EntityContract
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

    // Each Clinical Trial Can Have Multiple Locations
    public function locations() {
        return $this->belongsToMany('App\Models\Location', 'clinicaltrial_location', 'clinicaltrial_id', 'location_id')
                    ->withTimestamps();
    }

    // Each Clinical Trial Item Can Have Many Companies
    public function companies() {
        return $this->belongsToMany('App\Models\Company', 'clinicaltrial_company', 'clinicaltrial_id', 'company_id')
                    ->withTimestamps();
    }

    // Each Clinical Trial Item Can Have Many People
    public function people() {
        return $this->belongsToMany('App\Models\Person', 'clinicaltrial_person', 'clinicaltrial_id', 'person_id')
                    ->withTimestamps();
    }

    // Each Clinical Trial Item Can Have Many Focus Categories
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
        return $this->belongsToMany(CtOutcomeMeasure::class, 'clinicaltrial_outcome_measures');
    }

    public function studyDesigns()
    {
        return $this->belongsToMany(CtStudyDesign::class, 'clinicaltrial_study_designs');
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

    // Each Clinical Trial has 1 Phase
    public function phase() {
        return $this->hasMany('App\Models\ClinicaltrialPhase', 'phases');
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

    //alias for title
    public function getNameAttribute()
    {
        return $this->attributes['title'];
    }

    // Set Slug Attribute When Setting Title
    public function setTitleAttribute($value) {

        // Get Title
        $this->attributes['title'] = $value;

        // Get NCT Number
        $nct_number = $this->attributes['nct_number'];

        // Assign Slug
        $this->attributes['slug'] = $nct_number . '-' . Str::slug($value);

    }

    /**
     * @return array
     */
    public static function getMergeMapping()
    {
        return [
            //attributes
            'title'                   => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'slug'                    => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'nct_number'              => [
                'type'  => EntityMergeHelper::TYPE_STRING,
                'label' => 'NCT Number',
            ],
            'acronym'                 => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'status'                  => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'study_results'           => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'gender'                  => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'age'                     => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'phases'                  => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'enrollment'              => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'funded_bys'              => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'study_type'              => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'other_ids'               => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'start_date'              => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'primary_completion_date' => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'completion_date'         => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'first_posted'            => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'results_first_posted'    => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'last_update_posted'      => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'study_url'               => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            //relations
            'companies'               => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'name',
            ],
            'locations'               => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'name',
            ],
            'people'                  => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'name',
            ],
            'focus'                   => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'name',
            ],
            'conditions'              => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'value',
            ],
            'interventions'           => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'value',
            ],
            'outcomeMeasures'        => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'value',
                'label'         => 'Outcome Measures',
            ],
            'studyDesigns'           => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'value',
                'label'         => 'Study Designs',
            ],
        ];
    }
}
