<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Investor extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'investors';
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

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // Each Investor Can Have Multiple Locations
    public function locations() {
        return $this->belongsToMany('App\Models\Location', 'investor_location', 'investor_id', 'location_id')
            ->withTimestamps();
    }

    // Each Investor Can Have Multiple Focus Categories
    public function focus() {
        return $this->belongsToMany('App\Models\Focus', 'focus_investor', 'investor_id', 'focus_id')
            ->withTimestamps();
    }

    // Each Investor Can Have Multiple Companies
    public function companies() {
        return $this->belongsToMany('App\Models\Company', 'company_investor', 'investor_id', 'company_id')
            ->withPivot(['type'])
            ->withTimestamps();
    }

    // Each Investor Can Have Multiple People
    public function people() {
        return $this->belongsToMany('App\Models\Person', 'investor_person', 'investor_id', 'person_id')
            ->withPivot(['role'])
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

    public function setLogoAttribute($value)
    {

        // Logo Filename
        $investor_name = Str::slug($this->name);

        // Generate Filename
        $filename = 'investor-' . $investor_name . '.png';

        // Attribute Name
        $attribute_name = "logo";
        
        // Disk
        $disk = 'local'; 
        
        // Destination Path
        $destination_path = "public/logos"; 

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
        }
    }
}
