<?php

namespace App\Models;

use Akaunting\Firewall\Models\Log;
use App\Models\Scopes\PublicStatusScope;
use App\Models\Traits\HasEntityContent;
use App\Models\Traits\SearchableEntity;
use App\User;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BookableListing extends Model
{
    use CrudTrait,
        SearchableEntity,
        HasEntityContent;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    const TYPE_CLINIC = 'Clinic';
    const TYPE_COACH = 'Coach';
    const TYPE_COURSE = 'Course';
    const TYPE_RETREAT = 'Retreat';
    const TYPE_THERAPIST = 'Therapist';

    const STATUS_PENDING = 'Pending';
    const STATUS_PUBLIC = 'Public';

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

    const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_PUBLIC
    ];

    private array $searchableRelationships = [
        'focus' => 'name',
    ];

    private $searchableMorphs = [
        'bookable' => 'name'
    ];

    private array $searchableSkippedFields = [];

    private string $searchableModelName = 'Bookable Listing';

    private array $geoSearch;

    protected $table = 'bookable_listings';
    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    protected static function booted()
    {
        static::addGlobalScope(new PublicStatusScope());
    }

    public function clearGlobalScopes()
    {
        static::$globalScopes = [];
    }

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

    public function directories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Directory::class)->withTimestamps();
    }

    public function focus(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Focus::class, 'bookable_listing_focus', 'bookable_listing_id', 'focus_id')->withTimestamps();
    }

    public function location(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopePractitioners($query) {
        return $query->whereIn('type', self::TYPES_CARE);
    }

    public function scopePublic($query) {
        return $query->where('status', self::STATUS_PUBLIC);
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
            return route('discover.bookable-listing.show', $this->slug);
        } catch (\Throwable $throwable) {
            return '';
        }
    }

    public function backpackViewButton($crud = false): string
    {
        return '<a class="btn btn-sm btn-link" target="_blank" href="' . $this->bookable_url . '">View</a>';
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

    public function getPluralTypeAttribute(): string
    {
        if ($this->type === self::TYPE_COACH) {
            return $this->type . 'es';
        } else {
            return $this->type . 's';
        }
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
        $this->attributes['location_id'] = $value;

        $location = Location::find($value);

        if ($location !== null) {
            $this->attributes['location_name'] = $location->name;
            $this->attributes['latitude'] = $location->latitude;
            $this->attributes['longitude'] = $location->longitude;
        }
    }
}
