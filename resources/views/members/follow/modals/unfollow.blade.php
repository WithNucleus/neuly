<div class="modal fade" id="unfollow-modal-{{ $followable_id }}" tabindex="-1" aria-labelledby="#unfollow-modal-{{ $followable_id }}-label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="h5 modal-title m-0" id="unfollow-modal-{{ $followable_id }}-label">Unfollow {{ $name }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <form action="{{ route('member.follow.detach') }}" method="post" class="needs-validation"
                              novalidate>
                            @csrf
                            @isset($previous_url)
                                <input type="hidden" name="previous_url" value="{{ $previous_url }}">
                            @endisset
                            <input type="hidden" name="followable_id" value="{{ $followable_id }}"/>
                            <input type="hidden" name="followable_type" value="{{ $followable_type }}"/>
                            <p class="lead">Are you sure?</p>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Nevermind</button>
                            <button class="btn btn-primary">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
