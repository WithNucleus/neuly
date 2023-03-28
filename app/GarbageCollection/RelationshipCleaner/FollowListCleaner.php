<?php

namespace App\GarbageCollection\RelationshipCleaner;

use App\Models\FollowList;
use Illuminate\Support\Facades\DB;

class FollowListCleaner
{
    private $lists = null;

    public function __construct()
    {
        $this->lists = FollowList::all()->pluck('id');
    }

    public function cleanFollowListRelation()
    {
        $messages = [];

        $messages[] = $this->cleanFollowableRelation();

        return $messages;
    }

    public function cleanFollowableRelation()
    {
        $orphened = DB::table('followables')
            ->select('id')
            ->whereNotIn('follow_list_id', $this->lists)
            ->get()->pluck('id');

        DB::table('followables')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Follow Lists and Followables.';
    }
}
