@include('members.includes.status-messages')

<form action="{{ route('member.bookmarks.store-list') }}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <div class="col-12 {{ !$sidebar ? 'col-md-6' : '' }}">
            <label for="name" class="font-weight-bold">List Name</label>
            <input type="text" class="form-control" name="name" placeholder="List Name" required>
        </div>
        @if(!$sidebar)
        <div class="col-12 col-md-6">
            <label for="slug" class="font-weight-bold">List URL <small>(Must be unique)</small></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">neuly.com/member/{{ Auth::user()->member_url ? Auth::user()->member_url : 'you' }}/lists/</span>
                </div>
                <input type="text" class="form-control rounded-right" name="slug" value="">
                <div class="valid-feedback text-success" style="display: none">
                    Looks good!
                </div>
            </div>
        </div>
        @endif
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

    <div class="form-group mb-0">
        <button type="submit" class="mt-2 btn btn-primary">Save</button>
    </div>

</form>

<script src="{{ asset('js/formValidation.js') }}"></script>
