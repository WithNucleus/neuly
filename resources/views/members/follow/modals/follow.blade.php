<div class="modal fade" id="follow-modal-{{ $followable_id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title m-0">Follow {{ $name }}</h1>
                <button type="button" class="close closeDetailModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <form action="{{ route('member.follow.attach') }}" method="post" class="needs-validation"
                              novalidate>
                            @csrf
                            <input type="hidden" name="followable_id" value="{{ $followable_id }}"/>
                            <input type="hidden" name="followable_type" value="{{ $followable_type }}"/>
                            <p class="lead mb-2">Set your notification options.</p>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="email_notification" id="email_notification"
                                           class="custom-control-input" value="1">
                                    <label for="email_notification" class="custom-control-label">Email
                                        notifications</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="app_notification" id="app_notification"
                                           class="custom-control-input" value="1">
                                    <label for="app_notification" class="custom-control-label">Neuly
                                        notifications</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Nevermind</button>
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
