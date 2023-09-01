<h2 class="h5">Add Nav Item</h2>

@if ($errors->navigationTileItems->count() > 0)
    <div class="alert alert-danger">
        @foreach ($errors->navigationTileItems->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

@if(Session::has('navigationTileItemSuccess'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('navigationTileItemSuccess') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<form action="{{ route('adminx.nav-tiles.items.store', $navigationTile->id) }}" method="post">
    @csrf

    <div class="form-group">
        <label for="type" class="sr-only">Type</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input js-link-type-radio" type="radio" name="type" id="addLinkRadio" value="link" checked>
            <label class="form-check-label" for="addLinkRadio">
                Link
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input js-link-type-radio" type="radio" name="type" id="addTitleRadio" value="title">
            <label class="form-check-label" for="addTitleRadio">
                Title
            </label>
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="sr-only">Name</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">Name</div>
            </div>
            <input type="text" class="form-control" name="name" id="name" placeholder="Neuly" required>
        </div>
    </div>

    <div class="form-group for-link-type">
        <label for="name" class="sr-only">URL</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">URL</div>
            </div>
            <input type="url" name="url" id="url" class="form-control" placeholder="https://">
        </div>
    </div>

    <div class="form-group for-link-type">
        <label for="name" class="sr-only">Badge (optional)</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">Badge</div>
            </div>
            <input type="text" name="badge" id="badge" class="form-control" placeholder="Coming soon! (leave blank for none)">
        </div>
    </div>

    <div class="form-group mt-3">
        <button type="submit" class="btn btn-secondarydark">Save</button>
    </div>
</form>
