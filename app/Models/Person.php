<?php

namespace App\Models;

use App\Helpers\Entity\FieldsMapping;
use App\Models\Contracts\EntityContract;
use App\Models\Contracts\EntityImageContract;
use App\Models\Traits\CrudShowEntityPageButton;
use App\Models\Traits\OldSlugRedirectable;
use App\Models\Traits\EntityImage;
use App\Models\Traits\SearchableEntity;
use App\Traits\HasFollowers;
use App\User;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Traits\LogsActivity;

class Person extends Model implements EntityContract, EntityImageContract
{
    use CrudTrait;
    use HasFollowers;
    use OldSlugRedirectable;
    use LogsActivity;
    use CrudShowEntityPageButton;
    use EntityImage;
    use SearchableEntity;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table   = 'people';
    protected $guarded = ['id'];

    // log activity for all attributes, which not listed in $guarded array
    protected static $logUnguarded = true;

    protected static $imageAttribute         = 'photo';
    protected static $imageFolderPath        = 'people';
    protected static $imageFilenameAttribute = 'id';

    private $searchableRelationships = [
        'companies' => 'name',
        'focus' => 'name',
        'locations' => 'name',
        'investors' => 'name',
        'research' => 'name',
        'events' => 'name',
        'clinicaltrials' => 'title',
    ];

    private $searchableSkippedFields = [
        'email',
        'twitter_followers',
        'instagram_followers',
        'secondary_email',
        'visibility'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $slugCount = Person::where('slug', $slug)->count();

        if ($slugCount > 0) {
            $slug = $slug . '-' . uniqid();
        }

        return $slug;
    }

    public static function findOrCreatePerson($name, $google_scholar)
    {

        $person = Person::where('name', $name)
            ->orWhere('google_scholar', $google_scholar)
            ->first();

        if ($person) {
            return $person;
        }

        try {
            $person = Person::create([
                'name' => $name,
                'slug' => self::generateUniqueSlug($name),
                'google_scholar' => $google_scholar,
            ]);

            return $person;

        } catch (QueryException $e) {
            $error_message = 'Error on findOrCreatePerson()' . "\n" . $e;

            Log::error($error_message);
        }
    }

    public function getLinkedIn()
    {
        if ($this->linkedin != null) {
            return '<a href="https://www.linkedin.com/in/' . $this->linkedin . '" target="_blank" rel="noopener noreferrer"><i class="lab la-linkedin-in"></i> ' . $this->linkedin . '</a>';
        }
    }

    public function getFacebook()
    {
        if ($this->facebook != null) {
            return '<a href="https://www.facebook.com/' . $this->facebook . '" target="_blank" rel="noopener noreferrer"><i class="lab la-facebook-f"></i> ' . $this->facebook . '</a>';
        }
    }

    public function getTwitter()
    {
        if ($this->twitter != null) {
            return '<a href="https://www.twitter.com/' . $this->twitter . '" target="_blank" rel="noopener noreferrer"><i class="lab la-twitter"></i> ' . $this->twitter . '</a>';
        }
    }

    public function getInstagram()
    {
        if ($this->instagram != null) {
            return '<a href="https://www.instagram.com/' . $this->instagram . '" target="_blank" rel="noopener noreferrer"><i class="lab la-instagram"></i> ' . $this->instagram . '</a>';
        }
    }

    public function getShowLink()
    {
        return '<a href="' . route('discover.people.show', $this->slug) . '">' . $this->name . '</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function companies()
    {
        return $this->belongsToMany('App\Models\Company', 'company_person', 'person_id', 'company_id')
            ->withPivot(['position'])
            ->withTimestamps();
    }

    public function focus()
    {
        return $this->belongsToMany(Focus::class, 'focus_person', 'person_id', 'focus_id');
    }

    public function locations()
    {
        return $this->belongsToMany('App\Models\Location', 'location_person', 'person_id', 'location_id')
            ->withTimestamps();
    }

    public function investors()
    {
        return $this->belongsToMany('App\Models\Investor', 'investor_person', 'person_id', 'investor_id')
            ->withPivot(['role'])
            ->withTimestamps();
    }

    public function research()
    {
        return $this->belongsToMany('App\Models\Research', 'person_research', 'person_id', 'research_id')
            ->withTimestamps();
    }

    public function events()
    {
        return $this->belongsToMany('App\Models\Event', 'event_person', 'person_id', 'event_id')
            ->withTimestamps();
    }

    public function clinicaltrials()
    {
        return $this->belongsToMany('App\Models\Clinicaltrial', 'clinicaltrial_person', 'person_id', 'clinicaltrial_id')
            ->withTimestamps();
    }

    public function relatedUser()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopePublic($query)
    {
        return $query->where('visibilty', '=', 'public');
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

    public function setPhotoAttribute($value)
    {
        $this->updateImageAttribute($value);
    }

    /**
     * @return array
     */
    public static function getFieldsMapping()
    {
        return [
            //attributes
            'name' => [
                'type' => FieldsMapping::TYPE_STRING,
                'required' => true,
            ],
            'slug' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'email' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'secondary_email' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'job_type' => [
                'type' => FieldsMapping::TYPE_ENUM,
                'values' => self::getJobTypeValues(),
                'required' => false,
            ],
            'byline' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'website' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'photo' => [
                'type' => FieldsMapping::TYPE_IMAGE,
            ],
            'linkedin' => [
                'type' => FieldsMapping::TYPE_STRING,
                'prefix' => 'https://www.linkedin.com/in/',
                'placeholder' => 'username',
            ],
            'facebook' => [
                'type' => FieldsMapping::TYPE_STRING,
                'prefix' => 'https://www.facebook.com/',
                'placeholder' => 'username',
            ],
            'twitter' => [
                'type' => FieldsMapping::TYPE_STRING,
                'prefix' => 'https://www.twitter.com/',
                'placeholder' => 'username',
            ],
            'google_scholar' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'bio' => [
                'type' => FieldsMapping::TYPE_TEXT,
            ],
            //relations
            'locations' => [
                'type' => FieldsMapping::TYPE_RELATION,
                'relation' => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'focus' => [
                'type' => FieldsMapping::TYPE_RELATION,
                'relation' => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'companies' => [
                'type' => FieldsMapping::TYPE_RELATION,
                'relation' => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
                'pivotColumns' => [
                    'position',
                ],
            ],
            'investors' => [
                'type' => FieldsMapping::TYPE_RELATION,
                'relation' => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
                'pivotColumns' => [
                    'role',
                ],
            ],
            'research' => [
                'type' => FieldsMapping::TYPE_RELATION,
                'relation' => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'events' => [
                'type' => FieldsMapping::TYPE_RELATION,
                'relation' => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'clinicaltrials' => [
                'type' => FieldsMapping::TYPE_RELATION,
                'relation' => FieldsMapping::RELATION_N_N,
                'relationField' => 'title',
            ],
        ];
    }

    public static function getListingRequestMapping()
    {
        $mapping = self::getFieldsMapping();
        $skipFields = ['slug', 'secondary_email', 'companies', 'investors'];

        foreach ($skipFields as $field) {
            unset($mapping[$field]);
        }

        $mapping['email']['hideOriginal'] = true;

        return $mapping;
    }

    public static function getJobTypeValues()
    {
        $jobTypes = config('static.person_job_types');
        sort($jobTypes);
        return array_combine($jobTypes, $jobTypes);
    }

    public function getEmails()
    {
        $personEmails = [];

        if ($this->email) {
            $personEmails[] = $this->email;
        }

        if ($this->secondary_email) {
            $personEmails[] = $this->secondary_email;
        }

        return $personEmails;
    }

    public function getSocialProfiles()
    {
        $social = [];

        if ($this->linkedin !== null) {
            $social[] = 'linkedin';
        }

        if ($this->facebook !== null) {
            $social[] = 'facebook';
        }

        if ($this->twitter !== null) {
            $social[] = 'twitter';
        }

        if ($this->google_scholar !== null) {
            $social[] = 'google';
        }

        return $social;
    }

    public function canBeViewed()
    {
        return $this->visibility === 'public' || Auth::check();
    }
}
