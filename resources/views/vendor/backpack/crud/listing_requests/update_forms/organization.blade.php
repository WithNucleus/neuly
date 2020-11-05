<div class="row">
    <div class="form-group col-6">
        <label>Logo:</label>
        <br />
        @if ($original->entityImageUrl)
            <img src="{{ $original->entityImageUrl }}" style="max-width: 300px">
        @endif
    </div>
    <div class="form-group col-6">
        <label>Logo:</label>
        <br />
        @if ($changes->entityImageUrl)
            <img src="{{ $changes->entityImageUrl }}"  style="max-width: 300px">
        @endif
        <input type="hidden" name="entity_logo" value="{{ $changes->logo }}">
        <div class="option-list">
            @if ($original->logo != '')
                <div class="option-item">
                    <input type="radio" name="entity_what_logo" value="original" @if ($changes->logo == '') checked @endif> <label> use original image</label>
                </div>
            @endif
            @if ($changes->logo != '')
                <div class="option-item text-success font-weight-bold">
                    <input type="radio" name="entity_what_logo" value="shown" checked/> <label> use submitted image</label>
                </div>
            @endif
            <div class="option-item">
                <input type="radio" name="entity_what_logo" value="new" /> <label> upload new image</label>
                <br/>
                <input type="file" name="entity_new_logo" />
            </div>
            <div class="option-item">
                <input type="radio" name="entity_what_logo" value="none" /> <label> remove image</label>
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
        <label for="entity_ownership">Ownership:</label>
        <select class="form-control" name="original_ownership" disabled>
            <option @if($original->ownership === "Public Company") selected @endif>Public Company</option>
            <option @if($original->ownership === "Privately Held") selected @endif>Privately Held</option>
            <option @if($original->ownership === "Educational Institution") selected @endif>Educational Institution</option>
            <option @if($original->ownership === "Government Agency") selected @endif>Government Agency</option>
            <option @if($original->ownership === "Non-Profit") selected @endif>Non-Profit</option>
        </select>
        <a href="#" class="btn btn-sm btn-link btn-restore-ownership">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->ownership) ? 'bg-success' : '' }}">
        <label for="entity_ownership">Ownership:</label>
        <select class="form-control" name="entity_ownership">
            @if($changes->ownership != '')
                <option @if($changes->ownership === "Public Company") selected @endif>Public Company</option>
                <option @if($changes->ownership === "Privately Held") selected @endif>Privately Held</option>
                <option @if($changes->ownership === "Educational Institution") selected @endif>Educational Institution</option>
                <option @if($changes->ownership === "Government Agency") selected @endif>Government Agency</option>
                <option @if($changes->ownership === "Non-Profit") selected @endif>Non-Profit</option>
            @else
                <option value="{{ $original->ownership }}" selected>{{ $original->ownership }}</option>
            @endif
        </select>
    </div>
</div>
@include('vendor.backpack.crud.listing_requests.update_forms.includes.select-focus')
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
        <label for="entity_summary">Summary:</label>
        <textarea class="form-control" name="original_summary" rows="3" disabled>{{ $original->summary }}</textarea>
        <a href="#" class="btn btn-sm btn-link btn-restore-summary">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->summary) ? 'bg-success' : '' }}">
        <label for="entity_summary">Summary:</label>
        <textarea class="form-control" name="entity_summary" rows="3">{{ ($changes->summary) ? $changes->summary : $original->summary }}</textarea>
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="entity_founded_date">Founded Date:</label>
        <input type="date" class="form-control" name="original_founded_date" value="{{ $original->founded_date }}" disabled>
        <a href="#" class="btn btn-sm btn-link btn-restore-founded-date">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->founded_date) ? 'bg-success' : '' }}">
        <label for="entity_founded_date">Founded Date:</label>
        <input type="date" class="form-control" name="entity_founded_date" value="{{ ($changes->founded_date) ? $changes->founded_date : $original->founded_date }}">
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="entity_valuation">Valuation:</label>
        <input type="number" class="form-control" name="original_valuation" value="{{ $original->valuation }}" disabled>
        <a href="#" class="btn btn-sm btn-link btn-restore-valuation">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->valuation) ? 'bg-success' : '' }}">
        <label for="entity_valuation">Valuation:</label>
        <input type="number" class="form-control" name="entity_valuation" value="{{ ($changes->valuation) ? $changes->valuation : $original->valuation }}">
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="entity_number_employees">Number of Employees:</label>
        <input type="number" class="form-control" name="original_number_employees" value="{{ $original->number_employees }}" disabled>
        <a href="#" class="btn btn-sm btn-link btn-restore-employees">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->number_employees) ? 'bg-success' : '' }}">
        <label for="entity_number_employees">Number of Employees:</label>
        <input type="number" class="form-control" name="entity_number_employees" value="{{ ($changes->number_employees) ? $changes->number_employees : $original->number_employees }}">
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="entity_total_funding_amount">Total Funding Amount:</label>
        <input type="number" class="form-control" name="original_total_funding_amount" value="{{ $original->total_funding_amount}}" disabled>
        <a href="#" class="btn btn-sm btn-link btn-restore-fundings">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->total_funding_amount) ? 'bg-success' : '' }}">
        <label for="entity_total_funding_amount">Total Funding Amount:</label>
        <input type="number" class="form-control" name="entity_total_funding_amount" value="{{ ($changes->total_funding_amount) ? $changes->total_funding_amount : $original->total_funding_amount }}">
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="entity_last_funding_date">Last Funding Date:</label>
        <input type="date" class="form-control" name="original_last_funding_date" value="{{ $original->last_funding_date }}" disabled>
        <a href="#" class="btn btn-sm btn-link btn-restore-last-funding">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->last_funding_date) ? 'bg-success' : '' }}">
        <label for="entity_last_funding_date">Last Funding Date:</label>
        <input type="date" class="form-control" name="entity_last_funding_date" value="{{ ($changes->last_funding_date) ? $changes->last_funding_date : $original->last_funding_date }}">
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="entity_ticker">Ticker Symbol:</label>
        <input type="text" class="form-control" name="original_ticker" value="{{ $original->ticker_symbol }}" disabled>
        <a href="#" class="btn btn-sm btn-link btn-restore-ticker">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->ticker_symbol) ? 'bg-success' : '' }}">
        <label for="entity_ticker">Ticker Symbol:</label>
        <input type="text" class="form-control" name="entity_ticker" value="{{ ($changes->ticker_symbol) ? $changes->ticker_symbol : $original->ticker_symbol }}">
    </div>
</div>
