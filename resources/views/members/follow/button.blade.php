@auth
    @isset($isFollowed)
        @if($isFollowed)
            <button title="Unfollow {{ $name }}" class="ml-1 btn btn-link p-0 text-left"
                    data-toggle="modal" data-target="#unfollow-modal-{{ $followable_id }}"><i class="fas fa-star fa-lg"></i>
            </button>
            @include('members.follow.modals.unfollow')
        @else
            <button class="btn btn-link p-0 load-ajax-modal text-left" title="Follow {{ $name }}"
                    data-title="Follow {{ $name }}"
                    data-path="{{ route('member.follow.getModal', ['type' => $followable_type, 'id' => $followable_id]) }}"
                    data-toggle="modal"
                    data-target="#dynamic-modal">
                <i class="far fa-star fa-lg"></i>
            </button>
        @endif
    @endisset
@endauth

