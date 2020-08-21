@include('members.includes.status-messages')

<form action="{{ route('member.bookmarks.store-list') }}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="name" class="sr-only">List Name</label>
        <input type="text" class="form-control mr-2 mt-2" name="name" placeholder="List Name" required>
    </div>

    <div class="form-group">
        <label for="name" class="sr-only">Description</label>
        <textarea class="form-control" name="description" placeholder="Description"></textarea>
    </div>

    <div class="form-group mb-0">
        <button type="submit" class="mt-2 btn btn-primary">Save</button>
    </div>

</form>

<script src="{{ asset('js/formValidation.js') }}"></script>
