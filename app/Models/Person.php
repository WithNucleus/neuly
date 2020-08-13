<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class Person extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'people';
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

    public static function findOrCreatePerson($name, $google_scholar) {

        // Find Person
        $person = Person::where('name', $name)
                         ->orWhere('google_scholar', $google_scholar)
                         ->first();

        // Get Info or Create One
        if ($person) {

            return $person;

        } else {

            // create person
            try {

                $person = Person::create([
                     'name' => $name,
                     'google_scholar' => $google_scholar,
                     'slug' => Str::slug($name)
                ]);

                return $person;

            } catch (QueryException $e) {

                $error_message = 'Error on findOrCreatePerson()' . "\n" . $e;

                Log::error($error_message);
            }
            
        }
        
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // Each Person Can Have Many Companies
    public function companies() {
        return $this->belongsToMany('App\Models\Company', 'company_person', 'person_id', 'company_id')
                    ->withPivot(['position'])
                    ->withTimestamps();
    }

    // Each Person Can Have Multiple Locations
    public function locations() {
        return $this->belongsToMany('App\Models\Location', 'location_person', 'person_id', 'location_id')
            ->withTimestamps();
    }

    // Each Person Can Have Many Investors
    public function investors() {
        return $this->belongsToMany('App\Models\Investor', 'investor_person', 'person_id', 'investor_id')
                    ->withPivot(['role'])
                    ->withTimestamps();
    }

    // Each Person Can Have Many Research Items
    public function research() {
        return $this->belongsToMany('App\Models\Research', 'person_research', 'person_id', 'research_id')
                    ->withTimestamps();
    }

    // Each Person Can Have Multiple Events
    public function events() {
        return $this->belongsToMany('App\Models\Event', 'event_person', 'person_id', 'event_id')
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

    public function setPhotoAttribute($value) {

        // Generate Filename
        $filename = 'photo-' . $this->id . '.png';
        
        // Disk
        $disk = 'local'; 
        
        // Destination Path
        $destination_path = "public/people"; 

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            // Make the image
            $image = \Image::make($value)->encode('png', 90);

            // Store the image on disk
            \Storage::disk($disk)->put($destination_path . '/' . $filename, $image->stream());

            // Delete the previous image, if there was one
            \Storage::disk($disk)->delete('public/' . $this->{'photo'});

            // Save the public path to the database
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);

            $this->attributes['photo'] = $public_destination_path . '/' . $filename;
            
        } else {

            // if the image was erased
            if ($value == null) {

                // delete the image from disk
                \Storage::disk($disk)->delete('public/' . $this->{'photo'});

                // set null in the database column
                $this->attributes['photo'] = null;

            } elseif (Str::startsWith($value, '/storage')) {

                // do nothing because image isn't updated

            } else {

                // moving listing request image
                $this->attributes['photo'] = $value;
            }

        }
    }
}
