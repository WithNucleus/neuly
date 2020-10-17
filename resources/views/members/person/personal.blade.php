@include('navbars.tabs-user-person')

<div class="py-4 col-12 col-lg-12">

    <div class="alert alert-danger errors alert-dismissible fade show" style="display:none">
        <ul class="plain-list mb-0 font-small"></ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    @include('members.includes.status-messages')

    <form id="user-profile" action="{{ route('user.settings') }}" method="post" class="needs-validation" novalidate>
        @csrf
        <div class="form-group row">
            <div class="col-12 col-md-12 mb-3 mb-md-0">
                <label for="visibility" class="font-weight-bold">Visibility</label>
                <select class="form-control" id="visibility">
                    <option>Public</option>
                    <option>Members only</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12 col-md-6 mb-3 mb-md-0">
                <label for="new_name" class="font-weight-bold">First Name</label>
                <input type="text" class="form-control" name="new_name" required>
                <div class="invalid-feedback">
                    Your first name is required.
                </div>
            </div>

            <div class="col-12 col-md-6">
                <label for="last_name" class="font-weight-bold">Last Name</label>
                <input type="text" class="form-control" name="last_name" required>
                <div class="invalid-feedback">
                    Your last name is required.
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12 col-md-12 mb-3 mb-md-0">
                <label for="bio" class="font-weight-bold">Biography</label>
                <textarea class="form-control" id="bio" rows="10"></textarea>
            </div>
        </div>
        <button type="submit" class="submit btn btn-primary">Save</button>
    </form>
</div>
