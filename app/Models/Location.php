<?php

namespace App\Models;

use App\Models\Traits\OldSlugRedirectable;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class Location extends Model
{
    use CrudTrait;
    use HasFollowers;
    use OldSlugRedirectable;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'locations';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

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

    // Each Location Can Have Multiple Companies
    public function companies() {
        return $this->belongsToMany('App\Models\Company', 'company_location', 'location_id', 'company_id')
            ->withTimestamps();
    }

    // Each Location Can Have Multiple People
    public function people() {
        return $this->belongsToMany('App\Models\Person', 'location_person', 'location_id', 'person_id')
            ->withTimestamps();
    }

    // Each Location Can Have Multiple Investors
    public function investors() {
        return $this->belongsToMany('App\Models\Investor', 'investor_location', 'location_id', 'investor_id')
            ->withTimestamps();
    }

    // Each Location Can Have Multiple Jobs
    public function jobs() {
        return $this->belongsToMany('App\Models\Job', 'job_location', 'location_id', 'job_id')
            ->withTimestamps();
    }

    // Each Location Can Have Multiple Events
    public function events() {
        return $this->belongsToMany('App\Models\Event', 'event_location', 'location_id', 'event_id')
            ->withTimestamps();
    }

    // Each Location Can Have Multiple Clinical Trials
    public function clinicaltrials() {
        return $this->belongsToMany('App\Models\Clinicaltrial', 'clinicaltrial_location', 'location_id', 'clinicaltrial_id')
            ->withTimestamps();
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
