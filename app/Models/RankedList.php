<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class RankedList extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'ranked_lists';
    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function attachEntity($rankableId, $rankableType)
    {
        $maxRank = $this->entities()->max('rank');
        $rank = $maxRank ? $maxRank + 1 : 1;
        $exists = $this->entities()
            ->where('rankable_id', $rankableId)
            ->where('rankable_type', $rankableType)
            ->exists();

        if ($exists) {
            return false;
        }

        $this->entities()->create([
            'rankable_id' => $rankableId,
            'rankable_type' => $rankableType,
            'rank' => $rank,
        ]);

        return true;
    }

    public function detachEntity($rankableId, $rankableType)
    {
        $this->entities()
            ->where('rankable_id', $rankableId)
            ->where('rankable_type', $rankableType)
            ->delete();
    }

    public function updateEntities($entities)
    {
        $this->entities()->delete();
        $this->entities()->createMany($entities);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function entities()
    {
        return $this->hasMany(RankableEntity::class);
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
}
