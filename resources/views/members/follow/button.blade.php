@auth
    @if($isFollowed)
        <button title="Unfollow {{ $name }}" class="ml-1 btn btn-link p-0 text-left"
                data-toggle="modal" data-target="#unfollow-modal-{{ $followable_id }}"><i class="fad fa-minus-circle fa-lg"></i>
        </button>
        @include('members.follow.modals.unfollow')
    @else
        <button title="Follow {{ $name }}" class="ml-1 btn btn-link p-0 text-left"
                data-toggle="modal" data-target="#follow-modal-{{ $followable_id }}"><i class="fad fa-plus-circle fa-lg"></i>
        </button>
	    @include('members.follow.modals.follow')
    @endif
@endauth

