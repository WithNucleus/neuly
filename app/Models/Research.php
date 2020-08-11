<?php

namespace App\Models;

use App\Traits\hasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Research extends Model
{
    use CrudTrait;
    use hasFollowers;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'research';
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
