<?php

namespace App\Repositories;

use Auth;
use App\Models\Follow;

class FollowRepository {

    /**
     * Get current user bookmarks for a specific entity.
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
