<div class="form-group">
    <label for="entity_name">Name:</label>
    <input type="text" class="form-control" name="entity_name" value="{{ $changes->name }}">
</div>
<div class="form-group">
    <label for="entity_website">Website:</label>
    <input type="url" class="form-control" name="entity_website" value="{{ $changes->website }}">
</div>
<div class="form-group">
    <label for="entity_type">Type:</label>
    <select class="form-control" name="entity_type">
        <option @if($changes->type === "Venture Capital") selected @endif>Venture Capital</option>
        <option @if($changes->type === "Private Equity") selected @endif>Private Equity</option>
        <option @if($changes->type === "Private Individual") selected @endif>Private Individual</option>
    </select>
</div>
