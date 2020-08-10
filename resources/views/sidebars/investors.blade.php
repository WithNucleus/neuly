@include('sidebars.filters.radio-buttons', [
    'label'     => 'Type',
    'name'      => 'type',
    'items'     => [
    				'Private Equity' => 'Private Equity',
    				'Venture Capital' => 'Venture Capital',
    				],
    'item_filters' => $filters_type
])

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Locations',
    'name'      => 'location',
    'items'     => $locations,
    'item_filters' => $filters_location
])

<div class="investors-people mb-4">
	<label for="people" class="h4">People</label>
	<div class="d-flex">
		<input type="text" class="typeahead form-control" name="people-search" placeholder="Search authors">
		<button class="btn btn-link px-1 text-primary"><i class="fad fa-search fa-lg"></i></button>
	</div>

	<div id="people-filter">
		<span class="d-block title"></span>

		@isset($filters_person_name)
			@foreach ($filters_person_name as $person)
				<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="people" id="{{ $person }}" value="{{ $person }}" checked>
                    <label class="custom-control-label" for="{{ $person }}">{{ $person }}</label>
                </div>
			@endforeach
		@endisset
	</div>
</div>

<div class="investors-organizations">
	<label for="organizations" class="h4">Organizations</label>
	<div class="d-flex">
		<input type="text" class="typeahead form-control" name="organizations-search" placeholder="Search organizations">
		<button class="btn btn-link px-1 text-primary"><i class="fad fa-search fa-lg"></i></button>
	</div>

	<div id="organizations-filter">
		<span class="d-block title"></span>

		@isset($filters_company_name)
			@foreach ($filters_company_name as $company)
				<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="company" id="{{ $company }}" value="{{ $company }}" checked>
                    <label class="custom-control-label" for="{{ $company }}">{{ $company }}</label>
                </div>
			@endforeach
		@endisset
	</div>
</div>

@include('sidebars.filters.scripts')