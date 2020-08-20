<?php

namespace App\Models;

use App\Models\Traits\OldSlugRedirectable;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Clinicaltrial extends Model
{
    use CrudTrait;
    use HasFollowers;
    use OldSlugRedirectable;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'clinicaltrials';
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

    // Each Clinical Trial Can Have Multiple Locations
    public function locations() {
        return $this->belongsToMany('App\Models\Location', 'clinicaltrial_location', 'clinicaltrial_id', 'location_id')
                    ->withTimestamps();
    }

    // Each Clinical Trial Item Can Have Many Companies
    public function companies() {
        return $this->belongsToMany('App\Models\Company', 'clinicaltrial_company', 'clinicaltrial_id', 'company_id')
                    ->withTimestamps();
    }

    // Each Clinical Trial Item Can Have Many People
    public function people() {
        return $this->belongsToMany('App\Models\Person', 'clinicaltrial_person', 'clinicaltrial_id', 'person_id')
                    ->withTimestamps();
    }

    // Each Clinical Trial Item Can Have Many Focus Categories
    public function focus() {
        return $this->belongsToMany('App\Models\Focus', 'clinicaltrial_focus', 'clinicaltrial_id', 'focus_id')
                    ->withTimestamps();
    }

    /**
     * Get all Sponsors and Collaborators combined together.
     *
     * @return Collection
     */
    public function sponsorsAndCollaborators()
    {
        return collect()
            ->merge($this->companies)
            ->merge($this->people)
            ->sortBy('name');
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

    // Set Slug Attribute When Setting Title
    public function setTitleAttribute($value) {

        // Get Title
        $this->attributes['title'] = $value;

        // Get NCT Number
        $nct_number = $this->attributes['nct_number'];

        // Assign Slug
        $this->attributes['slug'] = $nct_number . '-' . Str::slug($value);

    }
}
