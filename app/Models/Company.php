<?php

namespace App\Models;

use App\Helpers\EntityMergeHelper;
use App\Models\Contracts\EntityContract;
use App\Models\Traits\OldSlugRedirectable;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Model implements EntityContract
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

    protected $table = 'companies';
    protected $guarded = ['id'];

    // log activity for all attributes, which not listed in $guarded array
    protected static $logUnguarded = true;
    protected static $logName = 'entities';

    protected static $companyToCompanyTypes = [
        'Full ownership',
        'Investor',
        'Partner'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

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

    public static function getCompanyToCompanyTypes()
    {
        return self::$companyToCompanyTypes;
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

    public function focus() {
        return $this->belongsToMany('App\Models\Focus', 'company_focus', 'company_id', 'focus_id')
                    ->withTimestamps();
    }

    public function people() {
        return $this->belongsToMany('App\Models\Person', 'company_person', 'company_id', 'person_id')
                    ->withPivot(['position'])
                    ->withTimestamps();
    }

    public function locations() {
        return $this->belongsToMany('App\Models\Location', 'company_location', 'company_id', 'location_id')
                    ->withTimestamps();
    }

    public function investors() {
        return $this->belongsToMany('App\Models\Investor', 'company_investor', 'company_id', 'investor_id')
                    ->withPivot(['type'])
                    ->withTimestamps();
    }

    public function research() {
        return $this->belongsToMany('App\Models\Research', 'company_research', 'company_id', 'research_id')
                    ->withTimestamps();
    }

    public function jobs() {
        return $this->hasMany('App\Models\Job');
    }

    public function events() {
        return $this->belongsToMany('App\Models\Event', 'company_event', 'company_id', 'event_id')
                    ->withTimestamps();
    }

    public function clinicaltrials() {
        return $this->belongsToMany('App\Models\Clinicaltrial', 'clinicaltrial_company', 'company_id', 'clinicaltrial_id')
                    ->withTimestamps();
    }

    public function parents() {
        return $this->belongsToMany(self::class, 'company_company', 'child_id', 'parent_id')
            ->withPivot('type');
    }

    public function subsidiaries() {
        return $this->belongsToMany(self::class, 'company_company', 'parent_id', 'child_id')
            ->withPivot('type');
    }

    public function valuations() {
        return $this->hasMany(CompanyValuation::class);
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

        $company_name     = Str::slug($this->name);
        $filename         = 'logo-' . $company_name . '.png';
        $disk             = 'local';
        $destination_path = "public/logos";

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            // Make the image
            $image = \Image::make($value)->encode('png', 90);
            // Delete the previous image, if there was one
            \Storage::disk($disk)->delete('public/' . $this->logo);
            // Store the image on disk
            \Storage::disk($disk)->put($destination_path . '/' . $filename, $image->stream());
            // Save the public path to the database
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);

            $this->attributes['logo'] = $public_destination_path . '/' . $filename;

        } else {

            // if the image was erased
            if ($value == null) {

                \Storage::disk($disk)->delete('public/' . $this->logo);
                $this->attributes['logo'] = null;

            } elseif (Str::startsWith($value, '/storage')) {

                // do nothing because image isn't updated

            } else {

                // moving listing request image
                $this->attributes['logo'] = $value;
            }

        }
    }

    /**
     * @return array
     */
    public static function getMergeMapping()
    {
        return [
            //attributes
            'name'                 => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'slug'                 => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'ownership'            => [
                'type'  => EntityMergeHelper::TYPE_STRING,
                'label' => 'Type',
            ],
            'ticker_symbol'        => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'website'              => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'founded_date'         => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'valuation'            => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'total_funding_amount' => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'last_funding_date'    => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'number_employees'     => [
                'type'  => EntityMergeHelper::TYPE_STRING,
                'label' => '# of Employees',
            ],
            'notes'                => [
                'type' => EntityMergeHelper::TYPE_TEXT,
            ],
            'summary'              => [
                'type' => EntityMergeHelper::TYPE_TEXT,
            ],
            'logo'                 => [
                'type' => EntityMergeHelper::TYPE_IMAGE,
            ],
            //relations
            'focus'                => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
            ],
            'locations'            => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
            ],
            'people'               => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
                'pivotColumns'  => [
                    'position'
                ],
            ],
            'investors'            => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
                'pivotColumns'  => [
                    'type'
                ],
            ],
            'research'             => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
            ],
            'jobs'                 => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'job_title',
            ],
            'events'               => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
            ],
            'clinicaltrials'       => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'title',
            ],
            'valuations'           => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_ONE_N,
                'relationField' => ['date', 'amount'],
            ]
        ];
    }
}
