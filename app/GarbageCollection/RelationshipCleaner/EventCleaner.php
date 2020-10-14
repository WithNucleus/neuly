<?php

namespace App\GarbageCollection\RelationshipCleaner;

use App\Models\Event;
use App\Models\EventType;
use App\Models\Focus;
use App\Models\Location;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

class EventCleaner
{
    private $events = null;
    private $types = null;
    private $focus = null;
    private $locations = null;
    private $people = null;

    public function __construct()
    {
        $this->events = Event::all()->pluck('id');
        $this->types = EventType::all()->pluck('id');
        $this->focus = Focus::all()->pluck('id');
        $this->locations = Location::all()->pluck('id');
        $this->people = Person::all()->pluck('id');
    }

    public function cleanEventRelation()
    {
        $messages = [];
        $messages[] = $this->cleanTypeRelation();
        $messages[] = $this->cleanFocusRelation();
        $messages[] = $this->cleanLocationRelation();
        $messages[] = $this->cleanPersonRelation();

        return $messages;
    }

    public function cleanTypeRelation()
    {
        $orphened = DB::table('event_event_type')
            ->select('event_id', 'event_type_id')
            ->whereNotIn('event_type_id', $this->types)
            ->orWhereNotIn('event_id', $this->events)
            ->get();

        foreach($orphened as $entry)
        {
            DB::table('event_event_type')
                ->where('event_id','=', $entry->event_id)
                ->where('event_type_id','=', $entry->event_type_id)
                ->delete();
        }

        return "Cleaned ".$orphened->count()." orphened Relationships between Events and EventTypes.";
    }

    public function cleanFocusRelation()
    {
        $orphened = DB::table('event_focus')
            ->select('event_id', 'focus_id')
            ->whereNotIn('focus_id', $this->focus)
            ->orWhereNotIn('event_id', $this->events)
            ->get();

        foreach($orphened as $entry)
        {
            DB::table('event_focus')
                ->where('event_id','=', $entry->event_id)
                ->where('focus_id','=', $entry->focus_id)
                ->delete();
        }

        return "Cleaned ".$orphened->count()." orphened Relationships between Events and Focus.";
    }

    public function cleanLocationRelation()
    {
        $orphened = DB::table('event_location')
            ->select('event_id', 'location_id')
            ->whereNotIn('location_id', $this->locations)
            ->orWhereNotIn('event_id', $this->events)
            ->get();

        foreach($orphened as $entry)
        {
            DB::table('event_location')
                ->where('event_id','=', $entry->event_id)
                ->where('location_id','=', $entry->location_id)
                ->delete();
        }

        return "Cleaned ".$orphened->count()." orphened Relationships between Events and Locations.";
    }

    public function cleanPersonRelation()
    {
        $orphened = DB::table('event_person')
            ->select('event_id', 'person_id')
            ->whereNotIn('person_id', $this->people)
            ->orWhereNotIn('event_id', $this->events)
            ->get();

        foreach($orphened as $entry)
        {
            DB::table('event_person')
                ->where('event_id','=', $entry->event_id)
                ->where('person_id','=', $entry->person_id)
                ->delete();
        }

        return "Cleaned ".$orphened->count()." orphened Relationships between Events and People.";
    }
}
