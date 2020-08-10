<div class="row">
    <div class="form-group col-6">
        <label class="d-block">Photo:</label>
        @if ($original->photo != '')
            <img src="{{ Storage::url($original->photo) }}" style="max-width: 300px;">
        @endif
    </div>
    <div class="form-group col-6">
        <label class="d-block">Photo:</label>
        @if ($changes->photo != '')
            <img src="{{ Storage::url($changes->photo) }}" style="max-width: 300px;">
        @endif
        <input type="hidden" name="entity_photo" value="{{ $changes->photo }}">

        <div class="option-list mt-3">
            @if ($original->photo != '')
                <div class="option-item">
                    <input type="radio" name="entity_what_photo" value="original" @if ($changes->photo == '') checked @endif> <label> use original image</label>
                </div>
            @endif
            @if ($changes->photo != '')
                <div class="option-item text-success font-weight-bold">
                    <input type="radio" name="entity_what_photo" value="shown" checked> <label> use shown image</label>
                </div>
            @endif
            <div class="option-item">
                <input type="radio" name="entity_what_photo" value="new" /> <label> upload new photo</label>
                <div class="mb-2 ml-3">
                    <input type="file" name="entity_new_photo" />
                </div>
            </div>
            <div class="option-item">
                <input type="radio" name="entity_what_photo" value="none" /> <label> use no image</label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="entity_name">Name:</label>
        <input type="text" class="form-control" name="original_name" value="{{ $original->name }}" disabled>
        <a href="#" class="btn btn-sm btn-link btn-restore-name">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->name != $original->name) ? 'bg-success' : '' }}">
        <label for="entity_name">Name:</label>
        <input type="text" class="form-control" name="entity_name" value="{{ $changes->name }}">
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="entity_email">E-Mail:</label>
        <input type="email" class="form-control" name="original_email" value="{{ $original->email }}" disabled>
        <a href="#" class="btn btn-sm btn-link btn-restore-email">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->email) ? 'bg-success' : '' }}">
        <label for="entity_email">E-Mail:</label>
        <input type="email" class="form-control" name="entity_email" value="{{ ($changes->email) ? $changes->email : $original->email }}">
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="entity_secondary_email">Secondary E-Mail:</label>
        <input type="email" class="form-control" name="original_secondary_email" value="{{ $original->secondary_email }}" disabled>
        <a href="#" class="btn btn-sm btn-link btn-restore-secondary">use original data</a>
    </div>
    <div class="form-group col-6">
        <label for="entity_secondary_email">Secondary E-Mail:</label>
        <input type="email" class="form-control" name="entity_secondary_email">
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="entity_website">Website:</label>
        <input type="url" class="form-control" name="original_website" value="{{ $original->website }}" disabled>
        <a href="#" class="btn btn-sm btn-link btn-restore-website">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->website) ? 'bg-success' : '' }}">
        <label for="entity_website">Website:</label>
        <input type="url" class="form-control" name="entity_website" value="{{ ($changes->website) ? $changes->website : $original->website }}">
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="entity_linkedin">Linkedin:</label>
        <input type="text" class="form-control" name="original_linkedin" value="{{ $original->linkedin }}" disabled>
        <a href="#" class="btn btn-sm btn-link btn-restore-linkedin">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->linkedin) ? 'bg-success' : '' }}">
        <label for="entity_linkedin">Linkedin:</label>
        <input type="text" class="form-control" name="entity_linkedin" value="{{ ($changes->linkedin) ? $changes->linkedin : $original->linkedin }}">
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="entity_facebook">Facebook:</label>
        <input type="text" class="form-control" name="original_facebook" value="{{ $original->facebook }}" disabled>
        <a href="#" class="btn btn-sm btn-link btn-restore-facebook">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->facebook) ? 'bg-success' : '' }}">
        <label for="entity_facebook">Facebook:</label>
        <input type="text" class="form-control" name="entity_facebook" value="{{ ($changes->facebook) ? $changes->facebook : $original->facebook }}">
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="entity_twitter">Twitter:</label>
        <input type="text" class="form-control" name="original_twitter" value="{{ $original->twitter }}" disabled>
        <a href="#" class="btn btn-sm btn-link btn-restore-twitter">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->twitter) ? 'bg-success' : '' }}">
        <label for="entity_twitter">Twitter:</label>
        <input type="text" class="form-control" name="entity_twitter" value="{{ ($changes->twitter) ? $changes->twitter : $original->twitter }}">
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="entity_bio">Bio</label>
        <textarea class="form-control" name="original_bio" rows="3" disabled>{{ $original->bio }}</textarea>
        <a href="#" class="btn btn-sm btn-link btn-restore-biography">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->bio) ? 'bg-success' : '' }}">
        <label for="entity_bio">Bio</label>
        <textarea class="form-control" name="entity_bio" rows="3">{{ ($changes->bio) ? $changes->bio : $original->bio }}</textarea>
    </div>
</div>
