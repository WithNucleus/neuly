<?php

namespace App\Models;

use App\Models\Traits\OldSlugRedirectable;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Research extends Model
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

    protected $table = 'research';
    protected $guarded = ['id'];

    // log activity for all attributes, which not listed in $guarded array
    protected static $logUnguarded = true;
    protected static $logName = 'entities';

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getShowLink() {
        return '<a href="' . route('discover.research.show', $this->slug) . '">' . $this->name . '</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // Each Research Item Can Have Many Focus Cats
    public function focus() {
        return $this->belongsToMany('App\Models\Focus', 'focus_research', 'research_id', 'focus_id')
                    ->withTimestamps();
    }

    // Each Research Item Can Have Many Companies
    public function companies() {
        return $this->belongsToMany('App\Models\Company', 'company_research', 'research_id', 'company_id')
                    ->withTimestamps();
    }

    // Each Research Item Can Have Many People
    public function people() {
        return $this->belongsToMany('App\Models\Person', 'person_research', 'research_id', 'person_id')
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

        // $this->attributes['slug'] = Str::slug($value);

        if (static::whereSlug($slug = Str::slug($value))->exists()) {
            $slug = "{$slug}-" . uniqid();
        }
        $this->attributes['slug'] = $slug;

    }
}
