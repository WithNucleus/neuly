<div class="form-group">
    <label>Job title:</label>
    <input type="text" class="form-control" name="entity_job_title" value="{{ $changes->job_title }}" required>
</div>
<div class="form-group">
    <label>Posted date:</label>
    <input type="date" class="form-control" name="entity_posted_date" value="{{ $changes->posted_date }}" required>
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
        <label class="font-weight-bold">New Company requested for this Job:</label>
        <input class="form-control" type="text" value="{{ $changes->company_new }}" readonly>
    </div>
@endif

@if(!empty($changes->investor_new))
    <div class="form-group bg-warning p-2">
        <label class="font-weight-bold">New Investor requested for this Job:</label>
        <input class="form-control" type="text" value="{{ $changes->investor_new }}" readonly>
    </div>
@endif

<div class="form-group">
    <label>Owner type:</label>
    <input class="form-control" type="text" name="entity_owner_type" value="{{ $changes->owner_type }}" readonly required>
</div>

<div class="form-group">
    <label>Owner:</label>
    <select name="entity_owner_id" class="form-control">
        @if($changes->owner_type === \App\Models\Company::class)
            @foreach($companies as $item)
                <option value="{{ $item->id }}" {{ $item->id === $changes->owner_id ? 'selected' : '' }}>
                    {{ $item->name }}
                </option>
            @endforeach
        @elseif($changes->owner_type === \App\Models\Investor::class)
            @foreach($investors as $item)
                <option value="{{ $item->id }}" {{ $item->id === $changes->owner_id ? 'selected' : '' }}>
                    {{ $item->name }}
                </option>
            @endforeach
        @endif
    </select>
</div>

@include('vendor.backpack.crud.listing_requests.entity_forms.includes.select-focus')

<div class="form-group">
    <label>Job Description:</label>
    <textarea class="form-control" name="entity_job_description" rows="5" required>{{ $changes->job_description }}</textarea>
</div>
