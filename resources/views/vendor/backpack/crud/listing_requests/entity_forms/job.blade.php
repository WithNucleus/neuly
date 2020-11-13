<div class="form-group">
    <label>Job title:</label>
    <input type="text" class="form-control" name="entity_job_title" value="{{ $changes->job_title }}">
</div>
<div class="form-group">
    <label>Posted date:</label>
    <input type="date" class="form-control" name="entity_posted_date" value="{{ $changes->posted_date }}">
</div>
<div class="form-group">
    <label>Salary:</label>
    <input type="number" class="form-control" name="entity_salary" value="{{ $changes->salary }}">
</div>
<div class="form-group">
    <label>Hourly rate:</label>
    <input type="number" class="form-control" name="entity_hourly_rate" value="{{ $changes->hourly_rate }}">
</div>

<div class="form-group">
    <label>Type:</label>
    <select class="form-control" name="entity_employment_type">
        <option value="Full Time" {{ $changes->employment_type == 'Full Time' ? 'selected' : '' }}>Full Time</option>
        <option value="Part Time" {{ $changes->employment_type == 'Part Time' ? 'selected' : '' }}>Part Time</option>
        <option value="One Time" {{ $changes->employment_type == 'One Time' ? 'selected' : '' }}>One Time</option>
    </select>
</div>

@if(!empty($changes->company_new))
    <div class="form-group bg-warning p-2">
        <label class="font-weight-bold">New company requested for this Job:</label>
        <input class="form-control" type="text" value="{{ $changes->company_new }}" readonly>
    </div>
@endif

@if(!empty($companies))
    <div class="form-group">
        <label>Company:</label>
        <select name="entity_company_id" class="form-control">
            @foreach($companies as $company)
                <option value="{{ $company->id }}"
                    {{ !empty($companyIdSelected) && $company->id == $companyIdSelected ? 'selected' : '' }}>
                    {{ $company->name }}
                </option>
            @endforeach
        </select>
    </div>
@endif

@include('vendor.backpack.crud.listing_requests.entity_forms.includes.select-focus')

<div class="form-group">
    <label>Job Description:</label>
    <textarea class="form-control" name="entity_job_description" rows="5">{{ $changes->job_description }}</textarea>
</div>
