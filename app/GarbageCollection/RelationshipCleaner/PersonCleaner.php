<?php

namespace App\GarbageCollection\RelationshipCleaner;

use App\Models\Person;
use App\Models\Research;
use Illuminate\Support\Facades\DB;

class PersonCleaner
{
    private $people = null;

    private $researchs = null;

    public function __construct()
    {
        $this->people = Person::all()->pluck('id');
        $this->researchs = Research::all()->pluck('id');
    }

    public function cleanPersonRelation()
    {
        $messages = [];

        $messages[] = $this->cleanResearchRelation();

        return $messages;
    }

    public function cleanResearchRelation()
    {
        $orphened = DB::table('person_research')
            ->select('person_id', 'research_id')
            ->whereNotIn('research_id', $this->researchs)
            ->orWhereNotIn('person_id', $this->people)
            ->get();

        foreach ($orphened as $entry) {
            DB::table('person_research')
                ->where('research_id', '=', $entry->research_id)
                ->where('person_id', '=', $entry->person_id)
                ->delete();
        }

        return 'Cleaned '.$orphened->count().' orphened Relationships between People and Researchs.';
    }
}
