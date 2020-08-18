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
            case 'clinicaltrials':
                return Clinicaltrial::find($id);
            case 'organizations':
                return Company::find($id);
            case 'events':
                return Event::find($id);
            case 'focus':
                return Focus::find($id);
            case 'investors':
                return Investor::find($id);
            case 'locations':
                return Location::find($id);
            case 'people':
                return Person::find($id);
            case 'research':
                return Research::find($id);
            default:
                return null;
        }
    }
}
