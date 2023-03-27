<?php

namespace App\Repositories;

use App\Models\Follow;
use Auth;

class FollowRepository
{
    /**
     * Get current user follows for a specific entity.
     *
     * @param string Entity
     * @return collection
     */
    public static function fromUser($entity, $entity_id)
    {
        return Follow::where('user_id', Auth::id())
            ->where('followable_type', $entity)
            ->where('followable_id', $entity_id)
            ->get();
    }
}
