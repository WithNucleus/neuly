<div class="form-group">
    <label class="d-block">Logo:</label>
    @if ($changes->logo != '')
        <img src="{{ Storage::url($changes->logo) }}" style="max-width: 300px;">
    @endif
    <input type="hidden" name="entity_logo" value="{{ $changes->logo }}">

    <div class="option-list mt-2">
        @if ($changes->logo != '')
            <div class="option-item">
                <input type="radio" name="entity_what_logo" value="shown" checked /> <label> use shown image</label>
            </div>
        @endif

        <div class="option-item">
            <input type="radio" name="entity_what_logo" value="new" /> <label> upload new photo</label>
            <div class="mb-2 ml-3">
                <input type="file" name="entity_new_logo" />
            </div>
        </div>
        <div class="option-item">
            <input type="radio" name="entity_what_logo" value="none" @if ($changes->logo == '') checked @endif> <label> use no image</label>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="entity_name">Name:</label>
    <input type="text" class="form-control" name="entity_name" value="{{ $changes->name }}">
</div>
<div class="form-group">
    <label for="entity_ownership">Ownership:</label>
    <select class="form-control" name="entity_ownership">
        <option @if($changes->ownership === "Public Company") selected @endif>Public Company</option>
        <option @if($changes->ownership === "Privately Held") selected @endif>Privately Held</option>
        <option @if($changes->ownership === "Educational Instituition") selected @endif>Educational Instituition</option>
        <option @if($changes->ownership === "Government Agency") selected @endif>Government Agency</option>
        <option @if($changes->ownership === "Non-Profit") selected @endif>Non-Profit</option>
    </select>
</div>
<div class="form-group">
    <label for="entity_website">Website:</label>
    <input type="url" class="form-control" name="entity_website" value="{{ $changes->website }}">
</div>
<div class="form-group">
    <label for="entity_summary">Summary:</label>
    <textarea class="form-control" name="entity_summary" rows="3">{{ $changes->summary }}</textarea>
</div>
<div class="form-group">
    <label for="entity_founded_date">Founded Date:</label>
    <input type="date" class="form-control" name="entity_founded_date" value="{{ $changes->founded_date }}">
</div>
<div class="form-group">
    <label for="entity_valuation">Valuation:</label>
    <input type="number" class="form-control" name="entity_valuation" value="{{ $changes->valuation }}">
</div>
<div class="form-group">
    <label for="entity_number_employees">Number of Employees:</label>
    <input type="number" class="form-control" name="entity_number_employees" {{ $changes->number_employees }}>
</div>
<div class="form-group">
    <label for="entity_total_funding_amount">Total Fundings:</label>
    <input type="number" class="form-control" name="entity_total_funding_amount">
</div>
<div class="form-group">
    <label for="entity_last_funding_date">Last Funding Date:</label>
    <input type="date" class="form-control" name="entity_last_funding_date">
</div>
<div class="form-group">
    <label for="entity_ticker">Ticker Symbol:</label>
    <input type="text" class="form-control" name="entity_ticker">
</div>
