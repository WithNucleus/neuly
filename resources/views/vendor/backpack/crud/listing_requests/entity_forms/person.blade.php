<div class="form-group">
    <label class="d-block">Photo:</label>
    @if ($changes->photo != '')
        <img src="{{ Storage::url($changes->photo) }}" />
    @endif
    <input type="hidden" name="entity_photo" value="{{ $changes->photo }}">

    <div class="option-list mt-2">
        @if ($changes->photo != '')
            <div class="option-item">
                <input type="radio" name="entity_what_photo" value="shown" checked /> <label> use shown image</label>
            </div>
        @endif
        <div class="option-item">
            <input type="radio" name="entity_what_photo" value="new" /> <label> upload new photo</label>
            <div class="mb-2 ml-3">
                <input type="file" name="entity_new_photo" />
            </div>
        </div>
        <div class="option-item">
            <input type="radio" name="entity_what_photo" value="none" @if ($changes->photo == '') checked @endif/> <label> use no image</label>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="entity_name">Name:</label>
    <input type="text" class="form-control" name="entity_name" value="{{ $changes->name }}">
</div>
<div class="form-group">
    <label for="entity_email">E-Mail:</label>
    <input type="email" class="form-control" name="entity_email" value="{{ $changes->email }}">
</div>
<div class="form-group">
    <label for="entity_secondary_email">Secondary E-Mail:</label>
    <input type="email" class="form-control" name="entity_secondary_email">
</div>
<div class="form-group">
    <label for="entity_website">Website:</label>
    <input type="url" class="form-control" name="entity_website" value="{{ $changes->website }}">
</div>
<div class="form-group">
    <label for="entity_linkedin">Linkedin:</label>
    <input type="text" class="form-control" name="entity_linkedin" value="{{ $changes->linkedin }}">
</div>
<div class="form-group">
    <label for="entity_facebook">Facebook:</label>
    <input type="text" class="form-control" name="entity_facebook" value="{{ $changes->facebook }}">
</div>
<div class="form-group">
    <label for="entity_twitter">Twitter:</label>
    <input type="text" class="form-control" name="entity_twitter" value="{{ $changes->twitter }}">
</div>
<div class="form-group">
    <label for="entity_bio">Biography</label>
    <textarea class="form-control" name="entity_bio" rows="3">{{ $changes->bio }}</textarea>
</div>
