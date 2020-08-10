@auth
	<button data-toggle="tooltip" data-placement="top" title="Follow {{ $name }}" class="ml-1 btn btn-link p-0 load-ajax-modal text-left" data-title="Add Bookmark" data-path="{{ route('member.bookmarks.add', ['entity' => $entity, 'entity_id' => $entity_id, 'name' => $name]) }}" data-toggle="modal" data-target="#dynamic-modal"><i class="fad fa-plus-circle fa-lg"></i></button>
@endauth