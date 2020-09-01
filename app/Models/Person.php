<?php

namespace App\Models;

use App\Helpers\EntityMergeHelper;
use App\Models\Contracts\EntityContract;
use App\Models\Traits\OldSlugRedirectable;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Traits\LogsActivity;

class Person extends Model implements EntityContract
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

    protected $table = 'people';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    // log activity for all attributes, which not listed in $guarded array
    protected static $logUnguarded = true;

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public static function generateUniqueSlug($name)
    {
        $slug      = Str::slug($name);
        $slugCount = Person::where('slug', $slug)->count();

        if ($slugCount > 0) {
            $slug = $slug . '-' . uniqid();
        }

        return $slug;
    }

    public static function findOrCreatePerson($name, $google_scholar) {

        $person = Person::where('name', $name)
            ->orWhere('google_scholar', $google_scholar)
            ->first();

        if ($person) {
            return $person;
        }

        try {
            $person = Person::create([
                'name'           => $name,
                'slug'           => self::generateUniqueSlug($name),
                'google_scholar' => $google_scholar,
            ]);

            return $person;

        } catch (QueryException $e) {
            $error_message = 'Error on findOrCreatePerson()' . "\n" . $e;

            Log::error($error_message);
        }
    }

    public function getLinkedIn() {
        if ($this->linkedin != null) {
            return '<a href="https://www.linkedin.com/in/' . $this->linkedin . '" target="_blank" rel="noopener noreferrer"><i class="lab la-linkedin-in"></i> ' . $this->linkedin . '</a>';
        }
    }

    public function getFacebook() {
        if ($this->facebook != null) {
            return '<a href="https://www.facebook.com/' . $this->facebook . '" target="_blank" rel="noopener noreferrer"><i class="lab la-facebook-f"></i> ' . $this->facebook . '</a>';
        }
    }

    public function getTwitter() {
        if ($this->twitter != null) {
            return '<a href="https://www.twitter.com/' . $this->twitter . '" target="_blank" rel="noopener noreferrer"><i class="lab la-twitter"></i> ' . $this->twitter . '</a>';
        }
    }

    public function getShowLink() {
        return '<a href="' . route('discover.people.show', $this->slug) . '">' . $this->name . '</a>';
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

    // Each Person Can Have Multiple Clinical Trials
    public function clinicaltrials() {
        return $this->belongsToMany('App\Models\Clinicaltrial', 'clinicaltrial_person', 'person_id', 'clinicaltrial_id')
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

        $filename = 'photo-' . $this->id . '.png';

        $disk = 'local';

        $destination_path = "public/people";

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            // Make the image
            $image = \Image::make($value)->encode('png', 90);

            // Store the image on disk
            \Storage::disk($disk)->put($destination_path . '/' . $filename, $image->stream());

            // Delete the previous image, if there was one
            \Storage::disk($disk)->delete('public/' . $this->photo);

            // Save the public path to the database
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);

            $this->attributes['photo'] = $public_destination_path . '/' . $filename;

        } else {

            // if the image was erased
            if ($value == null) {

                // delete the image from disk
                \Storage::disk($disk)->delete('public/' . $this->photo);

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

    /**
     * @return array
     */
    public static function getMergeMapping()
    {
        return [
            //attributes
            'name'            => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'slug'            => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'email'           => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'secondary_email' => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'website'         => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'photo'           => [
                'type' => EntityMergeHelper::TYPE_IMAGE,
            ],
            'linkedin'        => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'facebook'        => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'twitter'         => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'google_scholar'  => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'bio'             => [
                'type' => EntityMergeHelper::TYPE_TEXT,
            ],
            //relations
            'locations'       => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'name',
            ],
            'companies'       => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'name',
            ],
            'investors'       => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'name',
            ],
            'research'        => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'name',
            ],
            'events'          => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'name',
            ],
            'clinicaltrials'  => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relationField' => 'title',
            ],
        ];
    }
}
