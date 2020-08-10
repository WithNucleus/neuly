<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Company;

class Bookmark extends Model
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'bookmarks';
    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // Each Bookmark Belongs to One Bookmark List
    public function list() {
        return $this->belongsTo('App\Models\BookmarkList', 'bookmark_list_id');
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setNameAttribute($value) {

        $this->attributes['name'] = $value;

        $this->attributes['slug'] = Str::slug($value);

    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function slug($entity, $entity_id)
    {

        $route = array(
            'route' => '',
            'slug' => ''
        );

        // Organizations
        if ($entity == 'organizations') {
            $record = Company::findOrFail($entity_id);

            $route['route'] = 'discover.organizations.show';
            $route['slug'] = $record->slug;
        }

        // People
        if ($entity == 'people') {
            $record = Person::findOrFail($entity_id);

            $route['route'] = 'discover.people.show';
            $route['slug'] = $record->slug;
        }

        // Investors
        if ($entity == 'investors') {
            $record = Investor::findOrFail($entity_id);

            $route['route'] = 'discover.investors.show';
            $route['slug'] = $record->slug;
        }

        // Research
        if ($entity == 'research') {
            $record = Research::findOrFail($entity_id);

            $route['route'] = 'discover.research.show';
            $route['slug'] = $record->slug;
        }

        // Locations
        if ($entity == 'locations') {
            $record = Location::findOrFail($entity_id);

            $route['route'] = 'discover.locations.show';
            $route['slug'] = $record->slug;
        }

        // Focus
        if ($entity == 'focus') {
            $record = Focus::findOrFail($entity_id);

            $route['route'] = 'discover.focus.show';
            $route['slug'] = $record->slug;
        }

        // Events
        if ($entity == 'events') {
            $record = Event::findOrFail($entity_id);

            $route['route'] = 'discover.events.show';
            $route['slug'] = $record->slug;
        }

        // Jobs
        if ($entity == 'jobs') {
            $record = Job::findOrFail($entity_id);

            $route['route'] = 'discover.jobs.show';
            $route['slug'] = $record->slug;
        }

        // Clinical Trials
        if ($entity == 'clinicaltrials') {
            $record = Clinicaltrial::findOrFail($entity_id);

            $route['route'] = 'discover.clinicaltrials.show';
            $route['slug'] = $record->slug;
        }

        // Member Notes -- Only Works for Users' Own Notes Right Now
        if ($entity == 'member-notes') {
            $record = MemberNote::findOrFail($entity_id);

            $route['route'] = 'member.notes.show';
            $route['slug'] = $record->slug;
        }
        
        // Return $route
        return $route;
    }

    // Image
    public function image($entity, $entity_id) {

        $image = '';

        // Organizations
        if ($entity == 'organizations') {
            $record = Company::findOrFail($entity_id);
            $image = $record->logo;
        }

        // Return $image
        return $image;

    }
}
