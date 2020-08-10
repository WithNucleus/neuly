<div class="form-group">
    <label for="entity_name">Name:</label>
    <input type="text" class="form-control" name="entity_name" value="{{ $changes->name }}">
</div>
<div class="form-group">
    <label for="entity_website">Website:</label>
    <input type="url" class="form-control" name="entity_website" value="{{ $changes->website }}">
</div>
<div class="form-group">
    <label for="entity_registration">Registration Website:</label>
    <input type="url" class="form-control" name="entity_registration" value="{{ $changes->registration }}">
</div>
<div class="form-group">
    <label for="entity_start">Start:</label>
    <input type="date" class="form-control" name="entity_start" value="{{ $changes->start }}">
</div>
<div class="form-group">
    <label for="entity_end">End:</label>
    <input type="date" class="form-control" name="entity_end" value="{{ $changes->end }}">
</div>
<div class="form-group">
    <label for="entity_description">Description</label>
    <textarea class="form-control" name="entity_description" rows="3">{{ $changes->description }}</textarea>
</div>
