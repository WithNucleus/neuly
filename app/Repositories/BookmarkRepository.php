<?php

namespace App\Repositories;

use Auth;
use App\Models\Bookmark;

class BookmarkRepository {

	/**
	 * Get current user bookmarks for a specific entity.
	 *
	 * @param string Entity
	 * @return collection
	 */
	public static function fromUser($entity, $entity_id)
	{
		return Bookmark::where('user_id', Auth::id())
            ->where('entity', $entity)
            ->where('entity_id', $entity_id)
            ->get();
	}
}
