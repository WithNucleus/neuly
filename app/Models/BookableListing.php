<?php

namespace App\Models;

use Akaunting\Firewall\Models\Log;
use App\Models\Traits\HasEntityContent;
use App\Models\Traits\SearchableEntity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BookableListing extends Model
{
    use CrudTrait,
        SearchableEntity,
        HasEntityContent;

    const TYPE_CLINIC = 'Clinic';
    const TYPE_COACH = 'Coach';
    const TYPE_COURSE = 'Course';
    const TYPE_RETREAT = 'Retreat';
    const TYPE_THERAPIST = 'Therapist';

    const TYPES_CARE = [
        self::TYPE_CLINIC,
        self::TYPE_COACH,
        self::TYPE_RETREAT,
        self::TYPE_THERAPIST,
    ];

    const TYPES = [
        self::TYPE_CLINIC,
        self::TYPE_COACH,
        self::TYPE_COURSE,
        self::TYPE_RETREAT,
        self::TYPE_THERAPIST,
    ];

    private array $searchableRelationships = [
        'focus' => 'name',
    ];

    private $searchableMorphs = [
        'bookable' => 'name'
    ];

    private array $searchableSkippedFields = [];

    private string $searchableModelName = 'Bookable Listing';

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'bookable_listings';
    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    private function generateUniqueSlug($name): string
    {
        $slug = Str::slug($name);
        $slugCount = BookableListing::where('slug', $slug)->count();

        if ($slugCount > 0) {
            $slug = $slug . '-' . uniqid();
        }

        return $slug;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function bookable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function bookableListingRequests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BookableListingRequest::class);
    }

    public function companyBranch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CompanyBranch::class);
    }

    public function focus(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Focus::class, 'bookable_listing_focus', 'bookable_listing_id', 'focus_id')
            ->withTimestamps();
    }

    public function location(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopePractitioners($query) {
        return $query
            ->where('type', self::TYPE_CLINIC)
            ->orWhere('type', self::TYPE_COACH)
            ->orWhere('type', self::TYPE_RETREAT)
            ->orWhere('type', self::TYPE_THERAPIST);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getBookableEntityShowUrlAttribute(): string
    {
        $route = match($this->bookable_type) {
            Company::class => 'discover.organizations.show',
            Person::class => 'discover.people.show',
        };

        try {
            return route($route, $this->bookable->slug);
        } catch (\Throwable $throwable) {
            return '';
        }
    }

    public function getBookableUrlAttribute(): string
    {
        try {
            return route('discover.bookable-listing.show', [strtolower($this->type), $this->slug]);
        } catch (\Throwable $throwable) {
            return '';
        }
    }

    public function getBookableImageAttribute(): string
    {
        if ($this->bookable->entityImageUrl) {
            return $this->bookable->entityImageUrl;
        } else {
            return match($this->bookable_type) {
                Company::class => '/images/image-placeholder.jpg',
                Person::class => '/images/person-blank.png'
            };
        }
    }

    public function getFullAddressAttribute(): string
    {
        $address = '';

        if ($this->address != '') {
            $address .= $this->address;
        }

        if ($this->location) {
            $address .= "<br>" . $this->location->name;
        }

        return nl2br($address);
    }

    public function getGoogleMapUrlAttribute(): string
    {
        $addressForGoogle = str_replace(',', '', $this->fullAddress);
        $addressForGoogle = str_replace('<br>', '+', $addressForGoogle);
        $addressForGoogle = str_replace(' ', '+', $addressForGoogle);
        return "https://google.com/maps/place/" . $addressForGoogle;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = self::generateUniqueSlug($value);
    }

    public function setLocationIdAttribute($value) {
        try {
            $location = Location::find($value);
            $this->attributes['city'] = $location->city;
            $this->attributes['state'] = $location->region;
            $this->attributes['latitude'] = $location->latitude;
            $this->attributes['longitude'] = $location->longitude;
        } catch (\Throwable $throwable) {
            Log::warning('Problem saving Location ID ' . $throwable->getMessage());
        }
    }
}
