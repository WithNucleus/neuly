<?php

namespace App\Models;

use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class Person extends Model
{
    use CrudTrait;
    use HasFollowers;

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

    // public function setNameAttribute($value) {

    //     $this->attributes['name'] = $value;

    //     // Is Slug Empty?
    //     if ($this->attributes['slug'] == '') {

    //         // Get Slug
    //         $slug = Str::slug($value);

    //         // Check if this Slug Has Been Taken
    //         $person = Person::where('slug', $slug)->first();

    //         // If Person Exists, add the ID to this one
    //         if ($person) {
    //             $this->attributes['slug'] = $slug . '-' . $this->id;
    //         } else {
    //             $this->attributes['slug'] = Str::slug($value);
    //         }

    //     }

    // }

    // public function setSlugAttribute($value) {

    // }

    public function setPhotoAttribute($value)
    {

        // Generate Filename
        $filename = 'photo-' . $this->id . '.png';

        // Attribute Name
        $attribute_name = "photo";

        // Disk
        $disk = 'local';

        // Destination Path
        $destination_path = "public/people";

        // if the image was erased
        if ($value==null) {

            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            // Make the image
            $image = \Image::make($value)->encode('png', 90);

            // Store the image on disk
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

            // 3. Delete the previous image, if there was one
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // 4. Save the public path to the database
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;

        } else {

            $this->attributes[$attribute_name] = $value;
        }
    }
}
