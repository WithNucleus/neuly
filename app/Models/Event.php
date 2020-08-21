<?php

namespace App\Models;

use App\Models\Traits\OldSlugRedirectable;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Event extends Model
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

    protected $table = 'events';
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

    // Each Event Can Have Multiple Companies
    public function companies() {
        return $this->belongsToMany('App\Models\Company', 'company_event', 'event_id', 'company_id')->withTimestamps();
    }

    // Each Event Can Have Multiple Focus Categories
    public function focus() {
        return $this->belongsToMany('App\Models\Focus', 'event_focus', 'event_id', 'focus_id')->withTimestamps();
    }

    // Each Event Can Have Multiple Locations
    public function locations() {
        return $this->belongsToMany('App\Models\Location', 'event_location', 'event_id', 'location_id')->withTimestamps();
    }

    // Each Event Can Have Multiple People
    public function people() {
        return $this->belongsToMany('App\Models\Person', 'event_person', 'event_id', 'person_id')->withTimestamps();
    }

    // Each Event Can Have Multiple Event Types
    public function eventTypes() {
        return $this->belongsToMany('App\Models\EventType', 'event_event_type', 'event_id', 'event_type_id')->withTimestamps();
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

    public function setImageAttribute($value)
    {

        // News Article Title
        $title = Str::slug($this->name);

        $date = $this->start_date;

        // Generate Filename
        $filename = 'event-' . $date . '-' . $title . '.png';

        // Attribute Name
        $attribute_name = "image";

        // Disk
        $disk = 'local';

        // Destination Path
        $destination_path = "public/events";

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
