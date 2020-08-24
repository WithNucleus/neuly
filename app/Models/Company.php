<?php

namespace App\Models;

use App\Models\Traits\OldSlugRedirectable;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Focus;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Model
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

    // Each Company Can Have Many Focus Categories
    public function focus() {
        return $this->belongsToMany('App\Models\Focus', 'company_focus', 'company_id', 'focus_id')
                    ->withTimestamps();
    }

    // Each Company Can Have Many People
    public function people() {
        return $this->belongsToMany('App\Models\Person', 'company_person', 'company_id', 'person_id')
                    ->withPivot(['position'])
                    ->withTimestamps();
    }

    // Each Company Can Have Multiple Locations
    public function locations() {
        return $this->belongsToMany('App\Models\Location', 'company_location', 'company_id', 'location_id')
                    ->withTimestamps();
    }

    // Each Company Can Have Multiple Investors
    public function investors() {
        return $this->belongsToMany('App\Models\Investor', 'company_investor', 'company_id', 'investor_id')
                    ->withPivot(['type'])
                    ->withTimestamps();
    }

    // Each Company Can Have Many Research Items
    public function research() {
        return $this->belongsToMany('App\Models\Research', 'company_research', 'company_id', 'research_id')
                    ->withTimestamps();
    }

    // Each Company Can Have Multiple Jobs
    public function jobs() {
        return $this->hasMany('App\Models\Job');
    }

    // Each Company Can Have Multiple Events
    public function events() {
        return $this->belongsToMany('App\Models\Event', 'company_event', 'company_id', 'event_id')
                    ->withTimestamps();
    }

    // Each Company Can Have Multiple Clinical Trials
    public function clinicaltrials() {
        return $this->belongsToMany('App\Models\Clinicaltrial', 'clinicaltrial_company', 'company_id', 'clinicaltrial_id')
                    ->withTimestamps();
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

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    // public function getPeopleAttribute($value) {
    //     // fetch it any way you want
    //     // but it'll have to be a JSON or PHP array when you return it

    //     // return ucfirst('test ' . $value);
    //     return 'bananas';
    //     // return $value;
    // }

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

        // Get this Company ID
        $company_id = $this->id;

        // Find Company Record
        $company = Company::find($company_id);

        // Decode json
        $person_relationship = json_decode($value, true);

        // Check if $value is empty
        if ($value != '[{"person":"","position":""}]') {

            // Setup Array to Sync Relationships
            $sync_array = array();

            // Loop through
            foreach($person_relationship as $relationship) {

                // Get Values
                $person_id = $relationship['person'];
                $position = $relationship['position'];

                // Push this Array to Sync Relationships
                $sync_array[$person_id] = ['position' => $position];

            }

            // Attach Relationships
            $company->people()->attach(
                $sync_array
            );
        }

    }

    public function setLogoAttribute($value)
    {

        $company_name = Str::slug($this->name);

        $filename = 'logo-' . $company_name . '.png';

        $disk = 'local';

        $destination_path = "public/logos";

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            // Make the image
            $image = \Image::make($value)->encode('png', 90);

            // Store the image on disk
            \Storage::disk($disk)->put($destination_path . '/' . $filename, $image->stream());

            // Delete the previous image, if there was one
            \Storage::disk($disk)->delete('public/' . $this->logo);

            // Save the public path to the database
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);

            $this->attributes['logo'] = $public_destination_path . '/' . $filename;

        } else {

            // if the image was erased
            if ($value == null) {

                // delete the image from disk
                \Storage::disk($disk)->delete('public/' . $this->logo);

                // set null in the database column
                $this->attributes['logo'] = null;

            } elseif (Str::startsWith($value, '/storage')) {

                // do nothing because image isn't updated

            } else {

                // moving listing request image
                $this->attributes['logo'] = $value;
            }

        }
    }
}