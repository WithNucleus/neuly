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
        <label for="entity_website">Website:</label>
        <input type="url" class="form-control" name="original_website" value="{{ $original->event_url }}" disabled>
        <a href="#" class="btn btn-sm btn-link btn-restore-website">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->website) ? 'bg-success' : '' }}">
        <label for="entity_website">Website:</label>
        <input type="url" class="form-control" name="entity_website" value="{{ ($changes->website) ? $changes->website : $original->website }}">
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="entity_registration">Registration Website:</label>
        <input type="url" class="form-control" name="original_registration" value="{{ $original->registration_url }}" disabled>
        <a href="#" class="btn btn-sm btn-link btn-restore-registration">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->registration) ? 'bg-success' : '' }}">
        <label for="entity_registration">Registration Website:</label>
        <input type="url" class="form-control" name="entity_registration" value="{{ ($changes->registration) ? $changes->registration : $original->registration_url }}">
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="entity_start">Start:</label>
        <input type="date" class="form-control" name="original_start" value="{{ $original->start_date }}" disabled>
        <a href="#" class="btn btn-sm btn-link btn-restore-start">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->start) ? 'bg-success' : '' }}">
        <label for="entity_start">Start:</label>
        <input type="date" class="form-control" name="entity_start" value="{{ ($changes->start) ? $changes->start : $original->start_date }}">
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="entity_end">End:</label>
        <input type="date" class="form-control" name="original_end" value="{{ $original->end_date }}" disabled>
        <a href="#" class="btn btn-sm btn-link btn-restore-end">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->end) ? 'bg-success' : '' }}">
        <label for="entity_end">End:</label>
        <input type="date" class="form-control" name="entity_end" value="{{ ($changes->end) ? $changes->end : $original->end_date }}">
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="entity_description">Description</label>
        <textarea class="form-control" name="original_description" rows="3" disabled>{{ $original->description }}</textarea>
        <a href="#" class="btn btn-sm btn-link btn-restore-description">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->description) ? 'bg-success' : '' }}">
        <label for="entity_description">Description</label>
        <textarea class="form-control" name="entity_description" rows="3">{{ ($changes->description) ? $changes->description : $original->description }}</textarea>
    </div>
</div>
