{{-- @include('sidebars.filters.textsearch', [
	'title' 		=> 'Person',
	'placeholder' 	=> 'e.g. Aaron Johnson',
	'prefetch' 		=> 'people/names.json',
	'column' 		=> 0
]) --}}

<div class="filter-checkbox-container mb-3" aria-label="Filter by additional options">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="is_investor" id="is_investor" value="1" @if ($filter_is_investor && $filter_is_investor == 1) checked @endif>
        <label class="custom-control-label lead-smaller" for="is_investor">Investor</label>
    </div>
</div>

<div class="filter-checkbox-container mb-3" aria-label="Filter by additional options">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="with_email" id="with_email" value="1" @if ($filter_with_email && $filter_with_email == 1) checked @endif>
        <label class="custom-control-label lead-smaller" for="with_email">With email</label>
    </div>
</div>

@include('sidebars.filters.typeahead', [
    'label'     => 'Organizations',
    'name'      => 'company',
    'items'     => $filters_companies,
    'action'    => route('searchassets.peopleOrganizations')
])

@include('sidebars.filters.locations', [
    'label' => 'Locations',
    'filters_location' => $filters_location,
    'actionUrl' => route('searchassets.peopleLocations'),
])

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Focus',
    'name'      => 'focus',
    'items'     => $focuses,
    'item_filters' => $filters_focuses
])

@include('sidebars.filters.scripts')
