{{-- @include('sidebars.filters.textsearch', [
	'title' 		=> 'Organization', 
	'placeholder' 	=> 'e.g. 920 Coalition', 
	'prefetch' 		=> 'organization/names.json',
	'column' 		=> 1
]) --}}

{{-- @include('sidebars.filters.textsearch', [
	'title' 		=> 'Investor', 
	'placeholder' 	=> 'e.g. Tabula Rasa Ventures', 
	'prefetch' 		=> 'investor/names.json',
	'column' 		=> 2
]) --}}

{{-- @include('sidebars.filters.focus', ['column' => '0']) --}}

<div class="focus-organizations mb-4">
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

<div class="popular-focus-categories">
	<h2 class="h4">Most Viewed</h2>

	<ul class="list-group list-group-flush">
		<li class="list-group-item bg-light">
			<a href="{{ route('discover.focus.show', 'psilocybin') }}">Psilocybin</a>
		</li>
		<li class="list-group-item bg-light">
			<a href="{{ route('discover.focus.show', 'mdma') }}">MDMA</a>
		</li>
		<li class="list-group-item bg-light">
			<a href="{{ route('discover.focus.show', 'lsd') }}">LSD</a>
		</li>
		<li class="list-group-item bg-light">
			<a href="{{ route('discover.focus.show', 'dmt') }}">DMT</a>
		</li>
		<li class="list-group-item bg-light">
			<a href="{{ route('discover.focus.show', 'ketamine') }}">Ketamine</a>
		</li>
		<li class="list-group-item bg-light">
			<a href="{{ route('discover.focus.show', 'ibogaine') }}">Ibogaine</a>
		</li>
		<li class="list-group-item bg-light">
			<a href="{{ route('discover.focus.show', 'ghb') }}">GHB</a>
		</li>
		<li class="list-group-item bg-light">
			<a href="{{ route('discover.focus.show', 'tryptamine') }}">Tryptamine</a>
		</li>
	</ul>
</div>

@include('sidebars.filters.scripts')