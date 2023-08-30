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
use App\Models\Traits\SearchableEntity;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\ImportedEntity;

class Clinicaltrial extends Model implements EntityContract
{
    use CrudTrait;
    use HasFollowers;
    use OldSlugRedirectable;
    use LogsActivity;
    use CrudShowEntityPageButton;
    use SearchableEntity;

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

    private $searchableRelationships = [
        'companies' => 'name',
        'focus' => 'name',
        'people' => 'name',
    ];

    private $searchableRenamedFields = [
        'title' => 'name',
    ];

    private $searchableModelName = 'Clinical Trial';

    const SEXES = [
        'FEMALE' => 'Female',
        'MALE' => 'Male',
        'ALL' => 'All'
    ];

    const STATUSES = [
        'ACTIVE_NOT_RECRUITING' => 'Active, not recruiting',
        'COMPLETED' => 'Completed',
        'ENROLLING_BY_INVITATION' => 'Enrolling by invitation',
        'NOT_YET_RECRUITING' => 'Not yet recruiting',
        'RECRUITING' => 'Recruiting',
        'SUSPENDED' => 'Suspended',
        'TERMINATED' => 'Terminated',
        'WITHDRAWN' => 'Withdrawn',
        'AVAILABLE' => 'Available',
        'NO_LONGER_AVAILABLE' => 'No longer available',
        'TEMPORARILY_NOT_AVAILABLE' => 'Temporarily not available',
        'APPROVED_FOR_MARKETING' => 'Approved for marketing',
        'WITHHELD' => 'Withheld',
        'UNKNOWN' => 'Unknown status'
    ];

    const AGENCY_CLASSES = [
        'NIH',
        'FED',
        'OTHER_GOV',
        'INDIV',
        'INDUSTRY',
        'NETWORK',
        'AMBIG',
        'OTHER',
        'UNKNOWN'
    ];

    const AGENCY_CLASSES_ORGANIZATION = [
        'NIH',
        'FED',
        'OTHER_GOV',
        'INDUSTRY',
        'NETWORK',
    ];

    const DESIGN_MASKING = [
        'NONE' => 'None (Open Label)',
        'SINGLE' => 'Single',
        'DOUBLE' => 'Double',
        'TRIPLE' => 'Triple',
        'QUADRUPLE' => 'Quadruple'
    ];

    const WHO_MASKED = [
        'PARTICIPANT' => 'Participant',
        'CARE_PROVIDER' => 'Care Provider',
        'INVESTIGATOR' => 'Investigator',
        'OUTCOMES_ASSESSOR' => 'Outcomes Assessor'
    ];

    const RESPONSIBLE_PARTY_TYPES = [
        'SPONSOR' => 'Sponsor',
        'PRINCIPAL_INVESTIGATOR' => 'Principal Investigator',
        'SPONSOR_INVESTIGATOR' => 'Sponsor-Investigator'
    ];

    const PRIMARY_PURPOSES = [
        'TREATMENT' => 'Treatment',
        'PREVENTION' => 'Prevention',
        'DIAGNOSTIC' => 'Diagnostic',
        'ECT' => 'Educational/Counseling/Training',
        'SUPPORTIVE_CARE' => 'Supportive Care',
        'SCREENING' => 'Screening',
        'HEALTH_SERVICES_RESEARCH' => 'Health Services Research',
        'BASIC_SCIENCE' => 'Basic Science',
        'DEVICE_FEASIBILITY' => 'Device Feasibility',
        'OTHER' => 'Other'
    ];

    const INTERVENTIONAL_ASSIGNMENTS = [
        'SINGLE_GROUP' => 'Single Group Assignment',
        'PARALLEL' => 'Parallel Assignment',
        'CROSSOVER' => 'Crossover Assignment',
        'FACTORIAL' => 'Factorial Assignment',
        'SEQUENTIAL' => 'Sequential Assignment'
    ];

    const DESIGN_ALLOCATIONS = [
        'RANDOMIZED' => 'Randomized',
        'NON_RANDOMIZED' => 'Non-Randomized',
        'NA' => 'N/A'
    ];

    const COLLABORATOR = 'Collaborator';

    const ARM_GROUP_TYPES = [
        'EXPERIMENTAL' => 'Experimental',
        'ACTIVE_COMPARATOR' => 'Active Comparator',
        'PLACEBO_COMPARATOR' => 'Placebo Comparator',
        'SHAM_COMPARATOR' => 'Sham Comparator',
        'NO_INTERVENTION' => 'No Intervention',
        'OTHER' => 'Other'
    ];

    const STANDARD_AGES = [
        'CHILD' => 'Child',
        'ADULT' => 'Adult',
        'OLDER_ADULT' => 'Older Adult'
    ];

    const DESIGN_TIME_PERSPECTIVE = [
        'RETROSPECTIVE' => 'Retrospective',
        'PROSPECTIVE' => 'Prospective',
        'CROSS_SECTIONAL' => 'Cross-Sectional',
        'OTHER' => 'Other'
    ];

    const OBSERVATIONAL_MODELS = [
        'COHORT' => 'Cohort',
        'CASE_CONTROL' => 'Case-Control',
        'CASE_ONLY' => 'Case-Only',
        'CASE_CROSSOVER' => 'Case-Crossover',
        'ECOLOGIC_OR_COMMUNITY' => 'Ecologic or Community',
        'FAMILY_BASED' => 'Family-Based',
        'DEFINED_POPULATION' => 'Defined Population',
        'NATURAL_HISTORY' => 'Natural History',
        'OTHER' => 'Other'
    ];

    const PHASES = [
        'NA' => 'Not Applicable',
        'EARLY_PHASE1' => 'Early Phase 1',
        'PHASE1' => 'Phase 1',
        'PHASE2' => 'Phase 2',
        'PHASE3' => 'Phase 3',
        'PHASE4' => 'Phase 4'
    ];

    protected $casts = [
        'primary_outcomes' => 'array',
        'secondary_outcomes' => 'array',
        'other_outcomes' => 'array',
        'arm_groups' => 'array',
        'who_masked' => 'array',
        'age_groups' => 'array'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->setSlug();
        });

        static::updating(function ($model) {
            $model->setSlug();
        });
    }

    private function setSlug()
    {
        $this->attributes['slug'] = $this->attributes['nct_number'].'-'.Str::slug($this->attributes['title']);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function locations(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Location::class, 'clinicaltrial_location', 'clinicaltrial_id', 'location_id')
            ->withTimestamps();
    }

    public function companies(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'clinicaltrial_company', 'clinicaltrial_id', 'company_id')
            ->withPivot(['type', 'class'])
            ->withTimestamps();
    }

    public function people(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Person::class, 'clinicaltrial_person', 'clinicaltrial_id', 'person_id')
            ->withPivot(['type', 'class'])
            ->withTimestamps();
    }

    public function focus(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Focus::class, 'clinicaltrial_focus', 'clinicaltrial_id', 'focus_id')
            ->withTimestamps();
    }

    public function conditions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(CtCondition::class, 'clinicaltrial_condition');
    }

    public function interventions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(CtIntervention::class, 'clinicaltrial_intervention')->withPivot(['type', 'description']);
    }

    // TODO: Remove -- no longer in use
    public function outcomeMeasures(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(CtOutcomeMeasure::class, 'clinicaltrial_outcome_measure');
    }

    // TODO: Remove -- no longer in use
    public function studyDesigns(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(CtStudyDesign::class, 'clinicaltrial_study_design');
    }

    public function parsingResult(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ClinicaltrialParsingResult::class);
    }

    public function sponsorsAndCollaborators(): \Illuminate\Support\Collection
    {
        return collect()
            ->merge($this->companies)
            ->merge($this->people)
            ->sortBy('name');
    }

    public function phase()
    {
        return $this->hasMany(\App\Models\ClinicaltrialPhase::class, 'phases');
    }

    public function imported(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(ImportedEntity::class, 'importable');
    }

    public function leadSponsor(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo('lead_sponsor', 'lead_sponsor_type', 'lead_sponsor_id');
    }

    public function responsibleParty(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo('responsible_party');
    }

    public function collaborators(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'clinicaltrial_company', 'clinicaltrial_id', 'company_id')
            ->withPivot(['type', 'class'])
            ->wherePivot('type', self::COLLABORATOR)
            ->withTimestamps();
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

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['Recruiting', 'Active, not recruiting', 'Available']);
    }

    public function scopeRecruiting($query) {
        return $query->where('status', 'Recruiting');
    }

    /**
     * @param  array  $years
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStartYear(Builder $query, ...$years)
    {
        return $query->whereIn(DB::raw('YEAR(start_date)'), $years);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getPrettyStartDateAttribute(): ?string
    {
        if ($this->start_date) {
            return Carbon::parse($this->start_date)->format('M Y');
        } else {
            return null;
        }
    }

    public function getPrettyLastUpdatePostedAttribute(): ?string
    {
        if ($this->last_update_posted) {
            return Carbon::parse($this->last_update_posted)->format('M Y');
        } else {
            return null;
        }
    }

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

    public function setConditionsAttribute($value)
    {
        $this->attributes['conditions'] = str_replace('|', ';', $value);
    }

    public function setInterventionsAttribute($value)
    {
        $this->attributes['interventions'] = str_replace('|', ';', $value);
    }

    /**
     * @return array
     */
    public static function getFieldsMapping()
    {
        return [
            //attributes
            'title' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'slug' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'nct_number' => [
                'type' => FieldsMapping::TYPE_STRING,
                'label' => 'NCT Number',
            ],
            'acronym' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'status' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'study_results' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'gender' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'age' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'phases' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'enrollment' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'funded_bys' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'study_type' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'other_ids' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'start_date' => [
                'type' => FieldsMapping::TYPE_DATE,
            ],
            'primary_completion_date' => [
                'type' => FieldsMapping::TYPE_DATE,
            ],
            'completion_date' => [
                'type' => FieldsMapping::TYPE_DATE,
            ],
            'first_posted' => [
                'type' => FieldsMapping::TYPE_DATE,
            ],
            'results_first_posted' => [
                'type' => FieldsMapping::TYPE_DATE,
            ],
            'last_update_posted' => [
                'type' => FieldsMapping::TYPE_DATE,
            ],
            'study_url' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'brief_summary' => [
                'type' => FieldsMapping::TYPE_TEXT,
            ],
            'detailed_description' => [
                'type' => FieldsMapping::TYPE_TEXT_EDITOR,
            ],
            'min_age' => [
                'type' => FieldsMapping::TYPE_INTEGER,
            ],
            'max_age' => [
                'type' => FieldsMapping::TYPE_INTEGER,
            ],
            //relations
            'companies' => [
                'type' => FieldsMapping::TYPE_RELATION,
                'relation' => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'locations' => [
                'type' => FieldsMapping::TYPE_RELATION,
                'relation' => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'people' => [
                'type' => FieldsMapping::TYPE_RELATION,
                'relation' => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'focus' => [
                'type' => FieldsMapping::TYPE_RELATION,
                'relation' => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'conditions' => [
                'type' => FieldsMapping::TYPE_RELATION,
                'relation' => FieldsMapping::RELATION_ONE_N,
                'relationField' => 'value',
            ],
            'interventions' => [
                'type' => FieldsMapping::TYPE_RELATION,
                'relation' => FieldsMapping::RELATION_ONE_N,
                'relationField' => 'value',
            ],
            'outcomeMeasures' => [
                'type' => FieldsMapping::TYPE_RELATION,
                'relation' => FieldsMapping::RELATION_ONE_N,
                'relationField' => 'value',
                'label' => 'Outcome Measures',
            ],
            'studyDesigns' => [
                'type' => FieldsMapping::TYPE_RELATION,
                'relation' => FieldsMapping::RELATION_ONE_N,
                'relationField' => 'value',
                'label' => 'Study Designs',
            ],
        ];
    }

    public static function getListingRequestMapping()
    {
        $mapping = self::getFieldsMapping();
        $skipFields = ['slug'];

        foreach ($skipFields as $field) {
            unset($mapping[$field]);
        }

        return $mapping;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(self::$logName);
    }
}
