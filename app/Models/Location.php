<?php

namespace App\Models;

use App\Helpers\EntityMergeHelper;
use App\Models\Contracts\EntityContract;
use App\Models\Traits\CrudShowEntityPageButton;
use App\Models\Traits\OldSlugRedirectable;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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

    public static function byCountries()
    {
        $byCountries = [];

        foreach (self::getCountries() as $alpha2code => $country) {
            $byCountries[$alpha2code]['name'] = $country;
            $byCountries[$alpha2code]['locations'] = self::where('alpha2code', '=', $alpha2code)->pluck('id')->toArray();
        }

        return $byCountries;
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
            'city'           => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'region'         => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'country'        => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            //relations
            'companies'      => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
            ],
            'people'         => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
            ],
            'investors'      => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
            ],
            'jobs'           => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'job_title',
            ],
            'events'         => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
            ],
            'clinicaltrials' => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'title',
            ],
        ];
    }
}
