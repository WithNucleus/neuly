<div class="row">
	<div class="col-12 col-md-8 col-lg-7">
        <p class="h5 text-body-emphasis">
            {{ $investor->type ?? 'Unknown Type' }}
        </p>

        @if($investor->locations->count() === 1)
            <div class="mb-2 lead">
                <a href="{{ route('discover.locations.show', $investor->locations->first()->slug) }}" class="text-decoration-none text-body-secondary">
                    <i class="fa-sharp fa-solid fa-location-dot me-2"></i>{{ $investor->locations->first()->name }}
                </a>
            </div>
        @endif

        @if($investor->website != '')
            <div class="lead mb-3">
                <a href="{{ $investor->website }}" target="_blank" rel="noopener noreferrer">{{ $investor->website }}</a>
            </div>
        @endif

        @if($investor->locations->count() > 1)
            <div class="my-4">
                <h3 class="mb-0">Locations</h3>
                <div class="w-auto d-flex">
                    <ul class="list-group list-group-flush lead me-auto w-auto">
                        @foreach ($investor->locations as $location)
                            <x-entities.related.location-list-item :location="$location" />
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
    <div class="col-12 col-md-4 col-lg-5">
		<div class="text-center">
            <div class="logo-is-contained mb-3" style="background-image: url('{{ $investor->entityImageUrl ?? asset('images/image-placeholder.jpg') }}')"></div>
        </div>
    </div>
</div>

@if($investor->companies->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="companyList" label="Organizations">
        @foreach ($investor->companies as $company)
            <x-entities.related.company-card :company="$company" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($investor->people->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="peopleList" label="People">
        @foreach ($investor->people as $person)
            <x-entities.related.person-card :person="$person" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($investor->jobs->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="jobsList" label="Jobs">
        @foreach ($investor->jobs as $job)
            <x-entities.related.job-card :job="$job" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif
