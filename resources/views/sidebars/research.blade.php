{{-- @include('sidebars.filters.textsearch', [
	'title' 		=> 'Research', 
	'placeholder' 	=> 'e.g. Clinical investigations', 
	'prefetch' 		=> 'research/names.json',
	'column' 		=> 0
]) --}}

{{-- @include('sidebars.filters.textsearch', [
	'title' 		=> 'Organization', 
	'placeholder' 	=> 'e.g. 920 Coalition', 
	'prefetch' 		=> 'organization/names.json',
	'column' 		=> 1
]) --}}

{{-- @include('sidebars.filters.textsearch', [
	'title' 		=> 'People', 
	'placeholder' 	=> 'e.g. Allergan', 
	'prefetch' 		=> 'people/names.json',
	'column' 		=> 2
]) --}}

{{-- @include('sidebars.filters.focus', ['column' => '3']) --}}

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Focus',
    'name'      => 'focus',
    'items'     => $focus_cats,
    'item_filters' => $filters_focus
])

{{-- @include('sidebars.filters.textsearch', [
	'title' 		=> 'People', 
	'placeholder' 	=> 'Search authors', 
	'prefetch' 		=> 'people/names.json',
	'column' 		=> 2
]) --}}

<div class="research-authors">
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

@include('sidebars.filters.scripts')