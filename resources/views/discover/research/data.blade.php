<div class="row">
    <div class="col-12 col-lg-7">
        @if($research->publication_info)
			<h2 class="h5 text-body-emphasis mb-3">
				{{ $research->publication_info }}
			</h2>
		@endif

        @if($research->focus->count() > 0)
            <div class="d-flex flex-wrap align-items-center my-4">
                @foreach ($research->focus as $item)
                    <a href="{{ route('discover.focus.show', $item->slug) }}" class="btn btn-secondary rounded-0 my-2 me-3 fs-6 py-1">{{ $item->name }}</a>
                @endforeach
            </div>
        @endif

        @if($research->abstract)
            <div>
                <h3>Abstract</h3>
                <p class="lead">
                    {{ $research->abstract }}
                </p>
            </div>
        @endif

        @if($research->link)
            <div class="mt-4 text-end">
                <a href="{{ $research->link }}" class="btn btn-lg btn-primary d-inline-flex align-items-center" target="_blank" rel="noopener noreferrer">
                    <span class="me-2">View Research</span><i class="fa-sharp fa-regular fa-arrow-up-right-from-square"></i>
                </a>
            </div>
        @endif

        @if($research->companies->count() > 0)
            <div>
                <h3 class="h4">{{ ($research->people->count() > 1) ? 'Publishers / Journals' : 'Publisher / Journal' }}</h3>
                <div class="row">
                    @foreach ($research->companies as $company)
                        <x-entities.related.company-card :company="$company" classes="col-12 col-md-6 mb-4" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    <div class="col-12 col-lg-5 col-xl-4 offset-xl-1">
        @isset($resources)
            <div class="h6 mb-3">
                @foreach ($resources as $resource)
                    <div class="my-2">
                        <a href="{{ $resource->link }}" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center justify-content-end text-decoration-none">
                            @isset($resource->file_format)
                                <span class="h4 d-block mb-0 me-2">
                                    @if($resource->file_format == 'PDF')
                                        <i class="fa-sharp fa-solid fa-file-pdf"></i>
                                    @elseif($resource->file_format == 'HTML')
                                        <i class="fa-sharp fa-regular fa-link"></i>
                                    @else
                                        [{{ $resource->file_format }}]
                                    @endif
                                </span>
                            @endisset
                            <span>{{ $resource->title }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        @endisset

        @if($research->people->count() > 0)
            <div>
                <h3 class="h4">{{ ($research->people->count() > 1) ? 'Authors' : 'Author' }}</h3>
                <div class="row">
                    @foreach ($research->people as $person)
                        <x-entities.related.person-card :person="$person"  classes="col-12 small-square-card mb-4" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
