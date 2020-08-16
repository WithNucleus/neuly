@auth
    @if($isFollowed)
        <button data-toggle="tooltip" data-placement="top" title="Unfollow {{ $name }}" class="ml-1 btn btn-link p-0 load-ajax-modal text-left" data-title="Unfollow Entity" data-path="{{ route('member.unfollow.add', ['entity' => $entity, 'id' => $entity_id]) }}" data-toggle="modal" data-target="#dynamic-modal"><i class="fad fa-minus-circle fa-lg"></i></button>
    @else
	    <button data-toggle="tooltip" data-placement="top" title="Follow {{ $name }}" class="ml-1 btn btn-link p-0 load-ajax-modal text-left" data-title="Follow Entity" data-path="{{ route('member.follow.add', ['entity' => $entity, 'id' => $entity_id]) }}" data-toggle="modal" data-target="#dynamic-modal"><i class="fad fa-plus-circle fa-lg"></i></button>
    @endif
@endauth

