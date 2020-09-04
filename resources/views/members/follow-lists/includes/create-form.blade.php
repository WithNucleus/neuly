@if(isset($isModal) && $isModal === true)
    <form action="{{ route('member.follow-lists.ajaxStore') }}" method="post" class="js-modal-add-follow-list-form" style="display:none">
@else
    <form action="{{ route('member.follow-lists.store') }}" method="post">
@endif

    @csrf
    <div class="form-group row">
        <div class="col-12">
            <label for="name" class="font-weight-bold">List Name</label>
            <input type="text" class="form-control" name="name" placeholder="List Name" required>
            <div class="alert alert-danger mt-2 mb-2 js-error-block" style="display: none;"></div>
        </div>
    </div>

    <div class="form-group">
        <label for="public" class="font-weight-bold">Visibility</label>
        <div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_public" id="private" value="0" checked>
                <label class="form-check-label" for="private">Private</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_public" id="public" value="1">
                <label class="form-check-label" for="public">Public</label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="description" class="font-weight-bold">Description</label>
        <textarea class="form-control" name="description" placeholder="Description"></textarea>
    </div>

    <div class="form-group mb-0 mt-2">
        <button type="submit" class="btn btn-primary js-submit-follow-list-btn" data-action="{{ route('member.follow-lists.validateName') }}">Save</button>
        @if(isset($isModal) && $isModal === true)
            <button class="btn btn-light js-modal-add-follow-list-cancel">Cancel</button>
        @endif
    </div>
</form>

<script>
$(document).on('click', '.js-submit-follow-list-btn', function (e) {
    e.preventDefault();

    let btn = $(this),
        form = btn.parents('form'),
        action = btn.data('action'),
        token = form.find("input[name='_token']").val(),
        nameInput = form.find("input[name='name']"),
        errorBlock = nameInput.siblings('.js-error-block'),
        name = nameInput.val();

    $.post(action, { '_token': token, 'name': name }, function (response) {
        if (response.status === 'ok') {
            form.submit();
        } else {
            errorBlock.empty();
            $.each(response.errors, function( i, value ) {
                errorBlock.append('<p>' + value + '</p>');
                errorBlock.show();
            });
        }
    });
});
</script>
