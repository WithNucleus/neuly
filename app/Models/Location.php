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
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\Traits\LogsActivity;

class Location extends Model implements EntityContract
{
    use CrudTrait;
    use HasFollowers;
    use OldSlugRedirectable;
    use LogsActivity;
    use CrudShowEntityPageButton;
    use Searchable;

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

    public function getShowLink()
    {
        return '<a href="'.route('discover.locations.show', $this->slug).'">'.$this->name.'</a>';
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
            $name = $city.', '.$region.', '.$country;
            $slug = Str::slug($name);

            $location = self::where('slug', $slug)
                ->orWhere(function ($query) use ($region, $city, $country) {
                    $query->where('country', $country)
                        ->where('region', $region)
                        ->where('city', $city);
                })
                ->first();
        } else {
            $name = $region.', '.$country;
            $slug = Str::slug($name);

            $location = self::where('slug', $slug)
                ->orWhere('name', $name)
                ->first();
        }

        if ($location) {
            return $location;
        }

        try {
            $location = self::create([
                'name'    => $name,
                'slug'    => $slug,
                'city'    => $city,
                'region'  => $region,
                'country' => $country,
            ]);

            return $location;
        } catch (QueryException $e) {
            $error_message = 'Error on findOrCreateLocation()'."\n".$e;
            Log::error($error_message);
        }
    }

    public static function getCountries()
    {
        return self::distinct('alpha2code')->pluck('country', 'alpha2code');
    }

    public static function byCountries($sort = 'ASC')
    {
        $byCountries = [];

        foreach (self::orderBy('country', $sort)->get() as $location) {
            if (! array_key_exists($location->alpha2code, $byCountries)) {
                $byCountries[$location->alpha2code]['name'] = $location->country;
            }
            $byCountries[$location->alpha2code]['locations'][] = $location->id;
        }

        return $byCountries;
    }

    public static function byRegions($country, $sort = 'ASC')
    {
        $byRegions = [];

        foreach (self::where('country', '=', $country)->orderBy('region', $sort)->get() as $location) {
            if (! array_key_exists($location->region_code, $byRegions)) {
                $byRegions[$location->region_code]['name'] = $location->region;
            }
            $byRegions[$location->region_code]['locations'][] = $location->id;
        }

        return $byRegions;
    }

    /**
     * Searchable Fields
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->transform($this->toArray());

        $array['companies'] = $this->companies->map(function ($data) {
            return $data['name'];
        })->toArray();

        $array['people'] = $this->people->map(function ($data) {
            return $data['name'];
        })->toArray();

        $array['investors'] = $this->investors->map(function ($data) {
            return $data['name'];
        })->toArray();

        $array['jobs'] = $this->jobs->map(function ($data) {
            return $data['job_title'];
        })->toArray();

        $array['events'] = $this->events->map(function ($data) {
            return $data['name'];
        })->toArray();

        $array['clinicaltrials'] = $this->clinicaltrials->map(function ($data) {
            return $data['title'];
        })->toArray();

        return $array;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function companies()
    {
        return $this->belongsToMany('App\Models\Company', 'company_location', 'location_id', 'company_id')
            ->withTimestamps();
    }

    public function people()
    {
        return $this->belongsToMany('App\Models\Person', 'location_person', 'location_id', 'person_id')
            ->withTimestamps();
    }

    public function investors()
    {
        return $this->belongsToMany('App\Models\Investor', 'investor_location', 'location_id', 'investor_id')
            ->withTimestamps();
    }

    public function jobs()
    {
        return $this->belongsToMany('App\Models\Job', 'job_location', 'location_id', 'job_id')
            ->withTimestamps();
    }

    public function events()
    {
        return $this->belongsToMany('App\Models\Event', 'event_location', 'location_id', 'event_id')
            ->withTimestamps();
    }

    public function clinicaltrials()
    {
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

    public function scopeEmptyCoordinates($query)
    {
        return $query->whereNull('latitude')->orWhereNull('longitude');
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
