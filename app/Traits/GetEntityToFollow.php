<?php

namespace App\Traits;

use App\Models\Clinicaltrial;
use App\Models\Company;
use App\Models\Event;
use App\Models\Focus;
use App\Models\Investor;
use App\Models\Location;
use App\Models\Person;
use App\Models\Research;

trait GetEntityToFollow {
    private function getEntity(String $entity, Int $id)
    {
        switch($entity)
        {
            case 'clinicaltrial':
                return Clinicaltrial::first($id);
            case 'organization':
                return Company::first($id);
            case 'event':
                return Event::first($id);
            case 'focus':
                return Focus::first($id);
            case 'investor':
                return Investor::first($id);
            case 'location':
                return Location::first($id);
            case 'person':
                return Person::first($id);
            case 'research':
                return Research::first($id);
            default:
                return null;
        }
    }
}
