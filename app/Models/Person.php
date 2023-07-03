<?php

namespace App\Models;

use App\Helpers\Entity\FieldsMapping;
use App\Models\Contracts\EntityContract;
use App\Models\Contracts\EntityImageContract;
use App\Models\Traits\CrudShowEntityPageButton;
use App\Models\Traits\EntityImage;
use App\Models\Traits\HasEntityContent;
use App\Models\Traits\OldSlugRedirectable;
use App\Models\Traits\SearchableEntity;
use App\Traits\HasFollowers;
use App\User;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
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
    use HasEntityContent;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    const VISIBILITY_PUBLIC = 'public';

    const VISIBILITY_PENDING = 'pending';

    const VISIBILITY_TYPES = [
        self::VISIBILITY_PUBLIC,
        self::VISIBILITY_PENDING,
    ];

    protected $table = 'people';

    protected $guarded = ['id'];

    // log activity for all attributes, which not listed in $guarded array
    protected static $logUnguarded = true;

    protected static $logName = 'entities';

    protected static $imageAttribute = 'photo';

    protected static $imageFolderPath = 'people';

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
        'visibility',
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
            $slug = $slug.'-'.uniqid();
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
            $error_message = 'Error on findOrCreatePerson()'."\n".$e;

            Log::error($error_message);
        }
    }

    public function getLinkedIn(): ?string
    {
        if ($this->linkedin != null) {
            return '<a href="https://www.linkedin.com/in/'.$this->linkedin.'" target="_blank" rel="noopener noreferrer"><i class="lab la-linkedin-in"></i> '.$this->linkedin.'</a>';
        } else {
            return NULL;
        }
    }

    public function getFacebook(): ?string
    {
        if ($this->facebook != null) {
            return '<a href="https://www.facebook.com/'.$this->facebook.'" target="_blank" rel="noopener noreferrer"><i class="lab la-facebook-f"></i> '.$this->facebook.'</a>';
        } else {
            return NULL;
        }
    }

    public function getTwitter(): ?string
    {
        if ($this->twitter != null) {
            return '<a href="https://www.twitter.com/'.$this->twitter.'" target="_blank" rel="noopener noreferrer"><i class="lab la-twitter"></i> '.$this->twitter.'</a>';
        } else {
            return NULL;
        }
    }

    public function getInstagram(): ?string
    {
        if ($this->instagram != null) {
            return '<a href="https://www.instagram.com/'.$this->instagram.'" target="_blank" rel="noopener noreferrer"><i class="lab la-instagram"></i> '.$this->instagram.'</a>';
        } else {
            return NULL;
        }
    }

    public function getWebsite(): ?string
    {
        if ($this->website != null) {
            return '<a href="'.$this->website.'" target="_blank" rel="noopener noreferrer"><i class="lab la-link"></i> '.$this->website.'</a>';
        } else {
            return NULL;
        }
    }

    public function getShowLink(): string
    {
        return '<a href="'.route('discover.people.show', $this->slug).'">'.$this->name.'</a>';
    }

    public static function getVisibilityValues(): array
    {
        return array_combine(self::VISIBILITY_TYPES, self::VISIBILITY_TYPES);
    }

    public function isPublic(): bool
    {
        return $this->visibility === 'public';
    }

    public function validateVisibilityCode($visibility_code): bool
    {
        return $this->visibility_code === $visibility_code;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function bookableListings(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(BookableListing::class, 'bookable');
    }

    public function companies(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_person', 'person_id', 'company_id')
            ->withPivot(['position'])
            ->withTimestamps();
    }

    public function focus(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Focus::class, 'focus_person', 'person_id', 'focus_id');
    }

    public function locations(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Location::class, 'location_person', 'person_id', 'location_id')
            ->withTimestamps();
    }

    public function investors(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Investor::class, 'investor_person', 'person_id', 'investor_id')
            ->withPivot(['role'])
            ->withTimestamps();
    }

    public function research(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Research::class, 'person_research', 'person_id', 'research_id')
            ->withTimestamps();
    }

    public function events(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_person', 'person_id', 'event_id')
            ->withTimestamps();
    }

    public function clinicaltrials(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Clinicaltrial::class, 'clinicaltrial_person', 'person_id', 'clinicaltrial_id')
            ->withTimestamps();
    }

    public function relatedUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function patents(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(Patent::class, 'entity', 'patent_relationships')->withTimestamps();
    }

    public function mediaItems(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(MediaItem::class, 'entity', 'media_item_relationships')->orderByDesc('date')->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeNotPublic($query)
    {
        return $query->where('visibility', '!=', 'public');
    }

    public function scopePublic($query)
    {
        return $query->where('visibility', 'public');
    }

    public function scopeHasInvestors($query)
    {
        return $query->whereHas('investors');
    }

    public function scopeHasUpcomingEvents($query)
    {
        return $query->whereHas('events', function ($subquery) {
            $subquery->where('start_date', '>=', Carbon::now()->toDateString());
        });
    }

    public function scopeHasResearch($query)
    {
        return $query->whereHas('research');
    }

    public function scopeHasClinicalTrials($query)
    {
        return $query->whereHas('clinicaltrials');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getShowExtendedBioAttribute(): bool
    {
        return (Str::wordCount($this->bio) > 60);
    }

    public function getShortBioAttribute(): string
    {
        return strip_tags(Str::words($this->bio, 60));
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = self::generateUniqueSlug($value);
    }

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
            'visibility' => [
                'type' => FieldsMapping::TYPE_ENUM,
                'values' => self::getVisibilityValues(),
            ],
            'visibility_code' => [
                'type' => FieldsMapping::TYPE_STRING,
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
        $skipFields = ['slug', 'secondary_email', 'companies', 'investors', 'visibility', 'visibility_code'];

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(self::$logName);
    }
}
