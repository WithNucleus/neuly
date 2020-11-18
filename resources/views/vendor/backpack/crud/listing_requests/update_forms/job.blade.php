<div class="row">
    <div class="form-group col-6">
        <label>Job title:</label>
        <input type="text" class="form-control" name="original_job_title" value="{{ $original->job_title }}" disabled>
        <a href="#" class="btn btn-sm btn-link js-btn-restore" data-target="job_title">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->job_title != $original->job_title) ? 'bg-success' : '' }}">
        <label>Job title:</label>
        <input type="text" class="form-control" name="entity_job_title" value="{{ $changes->job_title }}" required>
    </div>
</div>

<div class="row">
    <div class="form-group col-6">
        <label>Posted date:</label>
        <input type="text" class="form-control datepicker" name="original_posted_date" value="{{ $original->posted_date }}" disabled>
        <a href="#" class="btn btn-sm btn-link js-btn-restore" data-target="posted_date">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->posted_date != $original->posted_date) ? 'bg-success' : '' }}">
        <label>Posted date:</label>
        <input type="text" class="form-control datepicker" name="entity_posted_date" value="{{ $changes->posted_date }}">
    </div>
</div>

<div class="row">
    <div class="form-group col-6">
        <label>Salary:</label>
        <input type="number" class="form-control" name="original_salary" value="{{ $original->salary }}" disabled>
        <a href="#" class="btn btn-sm btn-link js-btn-restore" data-target="salary">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->salary != $original->salary) ? 'bg-success' : '' }}">
        <label>Salary:</label>
        <input type="number" class="form-control" name="entity_salary" value="{{ $changes->salary }}">
    </div>
</div>

<div class="row">
    <div class="form-group col-6">
        <label>Hourly rate:</label>
        <input type="number" class="form-control" name="original_hourly_rate" value="{{ $original->hourly_rate }}" disabled>
        <a href="#" class="btn btn-sm btn-link js-btn-restore" data-target="hourly_rate">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->hourly_rate != $original->hourly_rate) ? 'bg-success' : '' }}">
        <label>Hourly rate:</label>
        <input type="number" class="form-control" name="entity_hourly_rate" value="{{ $changes->hourly_rate }}">
    </div>
</div>

<div class="row">
    <div class="form-group col-6">
        <label for="original_employment_type">Employment Type:</label>
        <select class="form-control" name="original_employment_type" disabled>
            <option value="{{ $original->employment_type }}">{{ $original->employment_type }}</option>
        </select>
        <a href="#" class="btn btn-sm btn-link js-btn-restore" data-target="employment_type">use original data</a>
    </div>
    <div class="form-group col-6 {{ ($changes->employment_type && $changes->employment_type != $original->employment_type) ? 'bg-success' : '' }}">
        <label for="entity_ownership">Employment Type:</label>
        <select class="form-control" name="entity_employment_type">
            @if($changes->employment_type)
                <option value="Full Time" {{ $changes->employment_type == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                <option value="Part Time" {{ $changes->employment_type == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                <option value="One Time" {{ $changes->employment_type == 'One Time' ? 'selected' : '' }}>One Time</option>
            @else
                <option value="{{ $original->employment_type }}" selected>{{ $original->employment_type }}</option>
            @endif
        </select>
    </div>
</div>

@isset($changes->company_new)
    <div class="row">
        <div class="form-group offset-6 col-6 bg-warning pb-4">
            <label class="font-weight-bold">New Company requested for this Job:</label>
            <input class="form-control" type="text" value="{{ $changes->company_new }}" readonly>
        </div>
    </div>
@endisset

@isset($changes->investor_new)
    <div class="row">
        <div class="form-group offset-6 col-6 bg-warning pb-4">
            <label class="font-weight-bold">New Investor requested for this Job:</label>
            <input class="form-control" type="text" value="{{ $changes->investor_new }}" readonly>
        </div>
    </div>
@endisset

<div class="row">
    <div class="form-group col-6">
        <label>Owner:</label>
        <input class="form-control" type="text" name="original_owner_type" value="{{ $original->owner_type }}" disabled>
        <br>
        <select name="original_owner_id" class="form-control" disabled>
            <option value="{{ $original->owner->id }}" selected>
                {{ $original->owner->name }}
            </option>
        </select>

        <a href="#" class="btn btn-sm btn-link js-btn-restore-job-owner" >use original data</a>
    </div>

    <div class="form-group col-6 {{ ($original->owner_type != $changes->owner_type)  ? 'bg-success' : '' }}">
        <label>Owner:</label>

        <div class="row">
            <div class="col-12">
                <div class="form-check form-check-inline">
                    <input id="company-owner-type" class="form-check-input js-owner-type-radio" data-type="company" type="radio"
                           name="entity_owner_type" value="{{ \App\Models\Company::class }}" required
                        {{ $changes->owner_type === \App\Models\Company::class ? 'checked' : '' }}>
                    <label for="company-owner-type" class="form-check-label">Company</label>
                </div>

                <div class="form-check form-check-inline">
                    <input id="investor-owner-type" class="form-check-input js-owner-type-radio" data-type="investor" type="radio"
                        name="entity_owner_type" value="{{ \App\Models\Investor::class }}" required
                        {{ $changes->owner_type === \App\Models\Investor::class ? 'checked' : '' }}>
                    <label for="investor-owner-type" class="form-check-label">Investor</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <select name="entity_owner_id" class="form-control js-owner-id-company" required
                    {!! $changes->owner_type === \App\Models\Company::class ? '' : 'disabled style="display: none;"' !!}>
                    @foreach($companies as $item)
                        <option value="{{ $item->id }}" {{ isset($changes->owner_id) && $changes->owner_id == $item->id  ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>

                <select name="entity_owner_id" class="form-control js-owner-id-investor" required
                    {!! $changes->owner_type === \App\Models\Investor::class ? '' : 'disabled style="display: none;"' !!}>
                    @foreach($investors as $item)
                        <option value="{{ $item->id }}" {{ isset($changes->owner_id) && $changes->owner_id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

@include('vendor.backpack.crud.listing_requests.update_forms.includes.select-focus')

<div class="row">
    <div class="form-group col-6">
        <label>Job Description:</label>
        <textarea class="form-control" name="original_job_description" rows="5" disabled>{{ $original->job_description }}</textarea>
        <a href="#" class="btn btn-sm btn-link js-btn-restore" data-target="job_description">use original data</a>
    </div>
    <div class="form-group col-6 {{ $changes->job_description !=  $original->job_description ? 'bg-success' : '' }}">
        <label>Job Description:</label>
        <textarea class="form-control" name="entity_job_description" rows="5" required>{{ $changes->job_description }}</textarea>
    </div>
</div>
