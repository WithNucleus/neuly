<?php

namespace App\Models;

use App\Helpers\Entity\FieldsMapping;
use App\Helpers\NotificationHelper;
use App\Models\Contracts\EntityContract;
use App\Models\Traits\CrudShowEntityPageButton;
use App\Models\Traits\OldSlugRedirectable;
use App\Notifications\LocationMapCodesNotFound;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Traits\LogsActivity;

class Location extends Model implements EntityContract
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

    protected $table = 'locations';
    protected $guarded = ['id'];

    // log activity for all attributes, which not listed in $guarded array
    protected static $logUnguarded = true;
    protected static $logName = 'entities';

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    protected static function booted()
    {
        static::created(function ($model) {
            $model->handleMapCodes();
            $model->save();
        });

        static::updating(function ($model) {
            $model->handleMapCodes(true);
        });
    }

    /**
     * @param bool $isUpdate
     */
    private function handleMapCodes($isUpdate = false)
    {
        $countryCodeNotFound = false;
        $regionCodeNotFound = false;

        if ($this->country && ($isUpdate === false || $this->country != $this->getOriginal('country'))) {
            $country = Country::where('name', $this->country)->first();

            if ($country) {
                $this->alpha2code = $country->alpha2code;
            } else {
                $this->alpha2code = null;
                $countryCodeNotFound = true;
            }
        }

        if ($this->region && ($isUpdate === false || $this->region != $this->getOriginal('region'))) {
            $locationWithRegionCode = self::where('country', $this->country)
                ->where('region', $this->region)
                ->whereNotNull('region_code')
                ->first();

            if ($locationWithRegionCode) {
                $this->region_code = $locationWithRegionCode->region_code;
            } else {
                $this->region_code = null;
                $regionCodeNotFound = true;
            }
        }

        if ($countryCodeNotFound || $regionCodeNotFound) {
            NotificationHelper::sendAdminNotifications(new LocationMapCodesNotFound($this, $countryCodeNotFound, $regionCodeNotFound));
        }
    }

    public function getShowLink() {
        return '<a href="' . route('discover.locations.show', $this->slug) . '">' . $this->name . '</a>';
    }

    /**
     * @param string $country
     * @param string $region
     * @param string $city
     * @return \App\Models\Location
     */
    public static function findOrCreateLocation($country, $region, $city = '')
    {
        if ($city) {
            $name = $city . ', ' . $region . ', ' . $country;
            $slug = Str::slug($name);

            $location = Location::where('slug', $slug)
                ->orWhere(function ($query) use ($region, $city, $country) {
                    $query->where('country', $country)
                        ->where('region', $region)
                        ->where('city', $city);
                })
                ->first();
        } else {
            $name = $region . ', ' . $country;
            $slug = Str::slug($name);

            $location = Location::where('slug', $slug)
                ->orWhere('name', $name)
                ->first();
        }

        if ($location) {
            return $location;
        }

        try {
            $location = Location::create([
                'name'    => $name,
                'slug'    => $slug,
                'city'    => $city,
                'region'  => $region,
                'country' => $country
            ]);

            return $location;

        } catch (QueryException $e) {
            $error_message = 'Error on findOrCreateLocation()' . "\n" . $e;
            Log::error($error_message);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function companies() {
        return $this->belongsToMany('App\Models\Company', 'company_location', 'location_id', 'company_id')
            ->withTimestamps();
    }

    public function people() {
        return $this->belongsToMany('App\Models\Person', 'location_person', 'location_id', 'person_id')
            ->withTimestamps();
    }

    public function investors() {
        return $this->belongsToMany('App\Models\Investor', 'investor_location', 'location_id', 'investor_id')
            ->withTimestamps();
    }

    public function jobs() {
        return $this->belongsToMany('App\Models\Job', 'job_location', 'location_id', 'job_id')
            ->withTimestamps();
    }

    public function events() {
        return $this->belongsToMany('App\Models\Event', 'event_location', 'location_id', 'event_id')
            ->withTimestamps();
    }

    public function clinicaltrials() {
        return $this->belongsToMany('App\Models\Clinicaltrial', 'clinicaltrial_location', 'location_id', 'clinicaltrial_id')
            ->withTimestamps();
    }

    // Each Location can have exactly one country
    public function officialCountry()
    {
        return $this->belongsTo('App\Models\Country', 'country', 'name');
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
            'city'           => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'region'         => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'country'        => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            //relations
            'companies'      => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'people'         => [
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
            'events'         => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'clinicaltrials' => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'title',
            ],
        ];
    }
}
