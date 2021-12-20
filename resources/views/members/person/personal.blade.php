@include('navbars.tabs-user-person')

<div class="py-4 col-12 col-lg-12">

    <div class="alert alert-danger errors alert-dismissible fade show" style="display:none">
        <ul class="plain-list mb-0 font-small"></ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    @include('members.includes.status-messages')

    <form id="user-profile" action="{{ route('user.person.personal.save') }}" method="post" class="needs-validation" novalidate>
        @csrf
        <div class="form-group row">
            <div class="col-12 col-md-12 mb-3 mb-md-0">
                <label for="name" class="font-weight-bold">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $person->name }}" required>
                <div class="invalid-feedback">
                    Your name is required.
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12 col-md-12 mb-3 mb-md-0">
                <label for="bio" class="font-weight-bold">Biography</label>
                <textarea class="form-control" name="bio" rows="10">{{ $person->bio }}</textarea>
            </div>
        </div>
        <button type="submit" class="submit btn btn-primary">Save</button>
    </form>
</div>
