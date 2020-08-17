<?php

namespace App\Models;

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
    public static function findOrCreateLocation($city, $region, $country) {

        // Find Location
        $location = Location::where('city', $city)
                         ->where('region', $region)
                         ->where('country', $country)
                         ->first();

        // Get Info or Create One
        if ($location) {

            return $location;

        } else {

            // create location
            try {

                $location = Location::create([
                     'name' => $city . ', ' . $region . ', ' . $country,
                     'city' => $city,
                     'region' => $region,
                     'country' => $country
                ]);

                return $location;

            } catch (QueryException $e) {

                $error_message = 'Error on findOrCreateLocation()' . "\n" . $e;

                Log::error($error_message);
            }

        }

    }

    public static function findOrCreateLocationNoCity($region, $country) {

        $name = $region . ', ' . $country;

        // Find Location
        $location = Location::where('name', $name)->first();

        // Get Info or Create One
        if ($location) {

            return $location;

        } else {

            // create location
            try {

                $location = Location::create([
                     'name' => $region . ', ' . $country,
                     'region' => $region,
                     'country' => $country
                ]);

                return $location;

            } catch (QueryException $e) {

                $error_message = 'Error on findOrCreateLocationNoCity()' . "\n" . $e;

                Log::error($error_message);
            }

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
