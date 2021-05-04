<?php

namespace App\Models;

use App\Helpers\Entity\FieldsMapping;
use App\Models\Contracts\EntityContract;
use App\Models\Contracts\EntityImageContract;
use App\Models\Traits\CrudShowEntityPageButton;
use App\Models\Traits\EntityImage;
use App\Models\Traits\OldSlugRedirectable;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Model implements EntityContract, EntityImageContract
{
    use CrudTrait;
    use HasFollowers;
    use OldSlugRedirectable;
    use LogsActivity;
    use CrudShowEntityPageButton;
    use EntityImage;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    const OWNERSHIP = [
        'Public Company',
        'Privately Held',
        'Educational Institution',
        'Government Agency',
        'Non-Profit',
    ];

    const COMPANY_TO_COMPANY_TYPES = [
        'Full ownership',
        'Investor',
        'Partner',
    ];

    protected $table = 'companies';
    protected $guarded = ['id'];

    protected $casts = [
        'founded_date' => 'date',
        'last_funding_date' => 'date',
    ];

    // log activity for all attributes, which not listed in $guarded array
    protected static $logUnguarded = true;
    protected static $logName = 'entities';

    protected static $imageAttribute = 'logo';
    protected static $imageFolderPath = 'logos';
    protected static $imageFilenameAttribute = 'name';

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    protected static function booted()
    {
        static::deleting(function ($model) {
            //remove polymorphic relation
            $model->jobs()->delete();
        });
    }

    public function getShowLink() {
        return '<a href="' . route('discover.organizations.show', $this->slug) . '">' . $this->name . '</a>';
    }

    public function getTypeDescription() {

        if ($this->ownership === 'Privately Held' OR $this->ownership === 'Non-Profit') {

            return 'a ' . strtolower($this->ownership) . ' organization';

        } elseif ($this->ownership === 'Educational Institution') {

            return 'an ' . strtolower($this->ownership);

        } else {

            return 'a ' . strtolower($this->ownership);
        }
    }

    /**
     * @return array
     */
    public static function getOwnershipValues()
    {
        return array_combine(self::OWNERSHIP, self::OWNERSHIP);
    }

    /**
     * @return array
     */
    public function getParentsAndSubsidiariesIgnoredIds()
    {
        return array_merge(
            [$this->id],
            $this->parents->pluck('id')->toArray(),
            $this->subsidiaries->pluck('id')->toArray()
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function focus()
    {
        return $this->belongsToMany('App\Models\Focus', 'company_focus', 'company_id', 'focus_id')
            ->withTimestamps();
    }

    public function people()
    {
        return $this->belongsToMany('App\Models\Person', 'company_person', 'company_id', 'person_id')
            ->withPivot(['position'])
            ->withTimestamps();
    }

    public function locations()
    {
        return $this->belongsToMany('App\Models\Location', 'company_location', 'company_id', 'location_id')
            ->withTimestamps();
    }

    public function investors()
    {
        return $this->belongsToMany('App\Models\Investor', 'company_investor', 'company_id', 'investor_id')
            ->withTimestamps();
    }

    public function research()
    {
        return $this->belongsToMany('App\Models\Research', 'company_research', 'company_id', 'research_id')
            ->withTimestamps();
    }

    public function jobs()
    {
        return $this->morphMany(Job::class, 'owner');
    }

    public function events()
    {
        return $this->belongsToMany('App\Models\Event', 'company_event', 'company_id', 'event_id')
            ->withTimestamps();
    }

    public function clinicaltrials()
    {
        return $this->belongsToMany('App\Models\Clinicaltrial', 'clinicaltrial_company', 'company_id', 'clinicaltrial_id')
            ->withTimestamps();
    }

    public function parents()
    {
        return $this->belongsToMany(self::class, 'company_company', 'child_id', 'parent_id')
            ->withPivot('type');
    }

    public function subsidiaries()
    {
        return $this->belongsToMany(self::class, 'company_company', 'parent_id', 'child_id')
            ->withPivot('type');
    }

    public function valuations()
    {
        return $this->hasMany(CompanyValuation::class);
    }

    public function serpapiData()
    {
        return $this->hasOne(CompanySerpapiData::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeHasJobs($query) {
        return $query->whereHas('jobs');
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeHasUpcomingEvents($query) {
        return $query->whereHas('events', function($subquery){
            $subquery->where('start_date', '>=', Carbon::now()->toDateString());
        });
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeNonprofits($query) {
        return $query->where('ownership', 'Non-Profit');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getLatestValuationAmountAttribute()
    {
        $latestValuation = $this->valuations()->latest('date')->first();

        return $latestValuation ? $latestValuation->amount : null;
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

    public function setpeopleRelationshipAttribute($value) {

        $company_id = $this->id;
        $company = Company::find($company_id);
        $person_relationship = json_decode($value, true);

        if ($value != '[{"person":"","position":""}]') {
            $sync_array = array();

            foreach($person_relationship as $relationship) {

                $person_id = $relationship['person'];
                $position = $relationship['position'];

                // Push this Array to Sync Relationships
                $sync_array[$person_id] = ['position' => $position];

            }

            $company->people()->attach(
                $sync_array
            );
        }

    }

    public function setLogoAttribute($value)
    {
        $this->updateImageAttribute($value);
    }

    /**
     * @return array
     */
    public static function getFieldsMapping()
    {
        return [
            //attributes
            'name'                 => [
                'type' => FieldsMapping::TYPE_STRING,
                'required' => true,
            ],
            'slug'                 => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'ownership'            => [
                'type'  => FieldsMapping::TYPE_ENUM,
                'label' => 'Type',
                'values' => self::getOwnershipValues(),
            ],
            'ticker_symbol'        => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'website'              => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'founded_date'         => [
                'type' => FieldsMapping::TYPE_DATE,
            ],
            'valuation'            => [
                'type' => FieldsMapping::TYPE_INTEGER,
            ],
            'total_funding_amount' => [
                'type' => FieldsMapping::TYPE_INTEGER,
            ],
            'last_funding_date'    => [
                'type' => FieldsMapping::TYPE_DATE,
            ],
            'number_employees'     => [
                'type'  => FieldsMapping::TYPE_INTEGER,
                'label' => '# of Employees',
            ],
            'notes'                => [
                'type' => FieldsMapping::TYPE_TEXT,
            ],
            'summary'              => [
                'type' => FieldsMapping::TYPE_TEXT,
            ],
            'logo'                 => [
                'type' => FieldsMapping::TYPE_IMAGE,
            ],
            //relations
            'focus'                => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'locations'            => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'people'               => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
                'pivotColumns'  => [
                    'position',
                ],
            ],
            'investors'            => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'research'             => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'jobs'                 => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_ONE_N_MORPHABLE,
                'relationField' => 'job_title',
            ],
            'events'               => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'clinicaltrials'       => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'title',
            ],
            'valuations'           => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_ONE_N,
                'relationField' => ['date', 'amount'],
            ],
        ];
    }

    public static function getListingRequestMapping()
    {
        $mapping = self::getFieldsMapping();
        $skipFields = ['slug', 'notes', 'jobs', 'people', 'valuations'];

        foreach ($skipFields as $field) {
            unset($mapping[$field]);
        }

        return $mapping;
    }

    public static function getImportSerpapiMapping()
    {
        $mapping = self::getFieldsMapping();
        $skipFields = ['slug', 'logo', 'jobs', 'people', 'valuations'];

        foreach ($skipFields as $field) {
            unset($mapping[$field]);
        }

        return $mapping;
    }
}
