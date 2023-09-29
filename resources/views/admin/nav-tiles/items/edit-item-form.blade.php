<form class="edit-item-form-{{ $item->id }}" action="{{ route('adminx.nav-tiles.items.update', $item->id) }}" method="post">
    @csrf

    <div class="form-group mb-3">
        <div class="form-check form-check-inline">
            <input class="edit-item-input-{{ $item->id }} form-check-input js-link-type-radio" type="radio" name="type" id="editLinkRadio" value="link" @if($item->type == 'link') checked @endif>
            <label class="form-check-label" for="editLinkRadio">
                Link
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input class="edit-item-input-{{ $item->id }} form-check-input js-link-type-radio" type="radio" name="type" id="editTitleRadio" value="title" @if($item->type == 'title') checked @endif>
            <label class="form-check-label" for="editTitleRadio">
                Title
            </label>
        </div>
    </div>

    <div class="form-group mb-3">
        <label for="name" class="sr-only">Name</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">Name</div>
            </div>
            <input type="text" class="edit-item-input-{{ $item->id }} form-control" name="name" value="{{ old('name') ?: $item->name }}" required>
        </div>
    </div>

    <div class="form-group mb-3 for-link-type">
        <label for="url" class="sr-only">URL</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">URL</div>
            </div>
            <input type="url" name="url" class="edit-item-input-{{ $item->id }} form-control" value="{{ old('url') ?: $item->url }}">
        </div>
    </div>

    <div class="form-group mb-3 for-link-type">
        <label for="badge" class="sr-only">Badge (optional)</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">Badge</div>
            </div>
            <input type="text" name="badge" class="edit-item-input-{{ $item->id }} form-control" value="{{ old('badge') ?: $item->badge }}">
        </div>
    </div>

    <div class="form-group mb-3 mt-3">
        <button type="submit" class="update-nav-item btn btn-primary" data-action="{{ route('adminx.nav-tiles.items.update', $item->id) }}" data-input-class="edit-item-input-{{ $item->id }}">Save</button>
    </div>
</form>
