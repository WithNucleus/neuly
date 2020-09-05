@extends('layouts.show-modal')

@section('content')

    @if($entity === null)
        <div class="alert alert-danger">
            <p>There was a problem with following, please try again later.</p>
        </div>
    @else
    <div class="row">
        <div class="col-12 col-md-6">
            <form action="{{ route('member.follow.attach') }}" method="post" class="js-modal-add-follow-form">
                @csrf

                <input type="hidden" name="followable_id" value="{{ $entity->id }}">
                <input type="hidden" name="followable_type" value="{{ get_class($entity) }}">

                <div class="form-group">
                    <label class="font-weight-bold">List</label>
                    <select name="follow_list_id" class="custom-select">
                        @foreach($lists as $list)
                            <option value="{{ $list->id }}">{{ $list->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-sm btn-secondary js-add-follow-list-btn"><i class="far fa-plus"></i> Add New List</button>
                </div>

                <div class="form-group">
                    <label for="notes" class="font-weight-bold">Notes</label>
                    <textarea name="notes" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <div>
                        <strong class="d-block">Notifications:</strong>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="email_notification" id="email_notification" value="1">
                            <label class="form-check-label" for="email_notification">Email</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="app_notification" id="app_notification" value="1" >
                            <label class="form-check-label" for="app_notification">Neuly</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="mt-2 btn btn-primary">Save</button>
                </div>
            </form>

            @include('members.follow-lists.includes.create-form', ['isModal' => true])
        </div>


    </div>
    @endif

    <script>
        let modalFollowForm = $('.js-modal-add-follow-form'),
            modalFollowListForm = $('.js-modal-add-follow-list-form');

        $(document).on('click', '.js-add-follow-list-btn', function (e) {
            e.preventDefault();

            modalFollowForm.hide();
            modalFollowListForm.show();
        });

        $(document).on('click', '.js-modal-add-follow-list-cancel', function (e) {
            e.preventDefault();

            modalFollowListForm.hide();
            modalFollowForm.show();
        });

        $(document).on('submit', '.js-modal-add-follow-list-form', function (e) {
            e.preventDefault();

            let action = modalFollowListForm.attr('action'),
                token = modalFollowListForm.find('input[name="_token"]').val(),
                name = modalFollowListForm.find('input[name="name"]').val(),
                isPublic = modalFollowListForm.find('input[name="is_public"]:checked').val(),
                description = modalFollowListForm.find('textarea[name="description"]').val();

            $.post(action, {
                '_token': token,
                'name': name,
                'is_public': isPublic,
                'description': description
            }, function (response) {
                if (response.status === 'ok') {
                    modalFollowForm.find('select[name=follow_list_id')
                        .append('<option value="' + response.data.id + '" selected>'+ response.data.name  + '</option>');
                }

                modalFollowListForm.hide();
                modalFollowForm.show();
            }, 'json');
        });
    </script>

    @include('discover.includes.modal')

@endsection
