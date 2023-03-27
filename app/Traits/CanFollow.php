<?php

namespace App\Traits;

use App\Models\Clinicaltrial;
use App\Models\Company;
use App\Models\Event;
use App\Models\Focus;
use App\Models\Investor;
use App\Models\Job;
use App\Models\Location;
use App\Models\Person;
use App\Models\Research;

trait CanFollow
{
    public function followedCompanies()
    {
        return $this->morphToMany(Company::class, 'followable');
    }

    public function followedPeople()
    {
        return $this->morphToMany(Person::class, 'followable');
    }

    public function followedResearch()
    {
        return $this->morphToMany(Research::class, 'followable');
    }

    public function followedLocations()
    {
        return $this->morphToMany(Location::class, 'followable');
    }

    public function followedEvents()
    {
        return $this->morphToMany(Event::class, 'followable');
    }

    public function followedFocuses()
    {
        return $this->morphToMany(Focus::class, 'followable');
    }

    public function followedClinicalTrials()
    {
        return $this->morphToMany(Clinicaltrial::class, 'followable');
    }

    public function followedInvestors()
    {
        return $this->morphToMany(Investor::class, 'followable');
    }

    public function followedJobs()
    {
        return $this->morphToMany(Job::class, 'followable');
    }
}
