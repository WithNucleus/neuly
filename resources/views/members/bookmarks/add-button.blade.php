@auth
	<button data-toggle="tooltip" data-placement="top" title="{{ count($bookmarks) > 0 ? 'View Bookmarks' : 'Add to Bookmarks' }}" class="btn btn-link p-0 load-ajax-modal text-left" data-title="Add Bookmark" data-path="{{ route('member.bookmarks.add', ['entity' => $entity, 'entity_id' => $entity_id, 'name' => $name]) }}" data-toggle="modal" data-target="#dynamic-modal">
		<i class="fad fa-bookmark fa-lg {{ count($bookmarks) > 0 ? 'text-success' : '' }}"></i>		
	</button>
@endauth