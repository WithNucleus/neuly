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
        <label for="entity_type">Type:</label>
        <select class="form-control" name="original_type" disabled>
            <option @if($original->type === "Venture Capital") selected @endif>Venture Capital</option>
            <option @if($original->type === "Private Equity") selected @endif>Private Equity</option>
            <option @if($original->type === "Private Individual") selected @endif>Private Individual</option>
        </select>
        <a href="#" class="btn btn-sm btn-link btn-restore-type">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->type) ? 'bg-success' : '' }}">
        <label for="entity_type">Type:</label>
        <select class="form-control" name="entity_type">
            @if($changes->type != '')
                <option @if($changes->type === "Venture Capital") selected @endif>Venture Capital</option>
                <option @if($changes->type === "Private Equity") selected @endif>Private Equity</option>
                <option @if($changes->type === "Private Individual") selected @endif>Private Individual</option>
            @else
                <option value="{{ $original->type }}" selected>{{ $original->type }}</option>
            @endif
        </select>
    </div>
</div>

