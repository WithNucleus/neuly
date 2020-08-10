<div class="row">
	<div class="col-12">

		<h1 class="h3 font-normal">{{ $research->name }}</h1>

		@if($research->publication_info != '')
			<p class="lead text-success mb-2">
				{{ $research->publication_info }}
			</p>
		@endif

		@if($research->companies->count() > 0)
			<p class="mb-2">
				<strong>Publisher / Journal:</strong>

				@foreach ($research->companies as $company)
				    <a href="{{ route('discover.organizations.show', $company->slug ) }}">{{ $company->name }}</a> @if (!$loop->last)<br>@endif
				@endforeach
			</p>
		@endif

		@if($research->people->count() > 0)
			<p class="mb-2">
				<strong>Author(s):</strong>
			
				@foreach ($research->people as $person)
				    <a href="{{ route('discover.people.show', $person->slug) }}">{{ $person->name }}</a>
				    
				    @if (!$loop->last),@endif
				@endforeach
			</p>
		@endif

		@if($research->focus->count() > 0)
			<p class="mb-2">
				<strong>Focus:</strong>

				@foreach ($research->focus as $item)
				    <a href="{{ route('discover.focus.show', $item->slug) }}">{{ $item->name }}</a>@if (!$loop->last),@endif
				@endforeach
			</p>
		@endif

		@if($research->abstract != '')
			<p class="mb-1">
				<strong>Abstract:</strong><br>
			</p>
			<p class="mb-2 border-bottom pb-2">
				{{ $research->abstract }}
			</p>
			{{-- <div class="bg-light p-2">
				{{ $research->abstract }}
			</div> --}}
		@endif

		<div class="d-flex align-items-center mt-3">
			<div class="mr-3">
				@if($research->link != '')
					{{-- <p class="mb-3 mt-3"> --}}
						<a href="{{ $research->link }}" class="btn btn-primary" target="_blank" rel="noopener noreferrer">
							View <i class="fad fa-external-link fa-xs"></i>
						</a>
					{{-- </p> --}}
				@endif
			</div>
			<div>
				@isset($resources)
					<p class="mb-0 font-large d-inline-flex align-items-center">
						@foreach ($resources as $resource)
							<span class="mr-3">
								<a href="{{ $resource->link }}" target="_blank" rel="noopener noreferrer" class="d-inline-flex align-items-center">
									@isset($resource->file_format)
										@if($resource->file_format == 'PDF')
											<i class="fad fa-file-pdf fa-2x mr-1"></i>
										@elseif($resource->file_format == 'HTML')
											<i class="fad fa-link fa-2x mr-1"></i>
										@else
											[{{ $resource->file_format }}]
										@endif
									@endisset
									{{ $resource->title }}
								</a>
							</span>
						@endforeach
					</p>
				@endisset
			</div>
		</div>

	</div>
</div>