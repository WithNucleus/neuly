<div class="{{ $widget['class'] ?? 'well mb-2' }} mt-4">

	<div class="row">

		<div class="col-12 col-md-8 col-xl-4 d-flex">
			<div class="card card-body flex-fill">

				<div>
					@if($widget['company']->logo != '')
						<img src="/storage/{{ $widget['company']->logo }}" alt="{{ $widget['company']->name }}" class="company-logo pull-right">
					@endif
					<h2 class="h3">{{ $widget['company']->name }}</h2>

					@if ($widget['company']->website != '')
						<p class="mb-2"><a href="{{ $widget['company']->website }}" target="_blank" rel="noopener noreferrer">
							{{ $widget['company']->website }} <i class="las la-external-link-alt"></i>
						</a></p>
					@endif

					{{-- @if ($widget['company']->slug != '')
						<p class="mb-2"><a href="{{ $widget['company']->slug }}" target="_blank" rel="noopener noreferrer">
							{{ $widget['company']->slug }} <i class="las la-external-link-alt"></i>
						</a></p>
					@endif --}}
			
					<p class="mb-0">
						<strong>Focus: </strong>
						@forelse ($widget['company']['focus'] as $item)
							<a href="/admin/focus/{{ $item->id }}/show">{{ $item->name }}</a>@if (!$loop->last) / @endif
						@empty
							-
						@endforelse
					</p>
				</div>

			</div>
		</div>

		<div class="col-12 col-md-8 col-xl-4 d-flex">
			<div class="card card-body flex-fill">
		
				<h5 class="mb-1">Location</h5>
		
				@forelse ($widget['company']['locations'] as $location)
					<a href="/admin/location/{{ $location->id }}/show">{{ $location->name }}</a>@if (!$loop->last) <br> @endif
				@empty
					-
				@endforelse

			</div>
		</div>
	</div>
	<div class="row">

		<div class="col-12 col-md-8 col-xl-4 d-flex">
			<div class="card card-body flex-fill">
		
				<div class="row mb-2">
					<div class="col"><h5 class="mb-1">People</h5></div>
					<div class="col text-right">
						<a href="/admin/companyperson/{{ $widget['company']->id }}" class="btn btn-sm btn-primary font-weight-bold">Add <i class='nav-icon la la-user'></i></a>

						{{-- <button class="btn btn-link p-0 load-ajax-modal text-left" data-title="{{ $widget['company']->name }}" data-path="/admin/companyperson/{{ $widget['company']->id }}" data-toggle="modal" data-target="#dynamic-modal">{{ $widget['company']->name }}</button> --}}
					</div>
				</div>
		
				@forelse ($widget['company']['people'] as $person)
					<div class="d-flex justify-content-between">
						<a href="/admin/person/{{ $person->id }}/show">
							{{ $person->name }} ({{ $person->getOriginal('pivot_position') }})
						</a> 
						<a class="small" onclick="return confirm_action()" href="{{ route('companyperson.remove', ['company_id' => $widget['company']->id, 'person_id' => $person->id]) }}">
							<i class="la la-trash"></i> Remove
						</a>
					</div>
				@empty
					-
				@endforelse

			</div>
		</div>

		<div class="col-12 col-md-8 col-xl-4 d-flex">
			<div class="card card-body flex-fill">
		
				<h5 class="mb-1">Investors</h5>
		
				@forelse ($widget['company']['investors'] as $investor)
					 <a href="/admin/investor/{{ $investor->id }}/show">{{ $investor->name }}</a> @if (!$loop->last) <br> @endif
				@empty
					-
				@endforelse

			</div>
		</div>

	</div>
</div>

<style>
	.company-logo {
		height:  auto;
		width:  75px;
		float:  right;
	}
</style>

<script>
    function confirm_action() {
        return confirm('are you sure?');
    }
</script>