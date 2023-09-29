<div class="mb-5 d-lg-flex mx-auto">
    <div class="d-flex flex-column flex-md-row border-bottom pb-5">
        @if(!$hideSource)
            <div class="order-2 order-md-1 flex-shrink-0 mt-3 mt-md-0 me-3 me-lg-4">
                <img src="{{ $record->source->entity_image_url ?? asset('images/image-placeholder-podcast.png') }}" alt="{{ $record->source->name }}" class="d-none d-md-block entity-square-image mb-3">
                <div class="d-md-flex flex-column justify-content-lg-center align-items-lg-center">
                    <a href="{{ $record->url }}" class="btn btn-primary rounded-0 me-2 me-md-0 mb-md-2 text-nowrap" target="_blank" rel="noopener noreferrer">
                        <span>Listen</span><span class="d-none d-xl-inline ms-1">Now</span>
                    </a>
                    <button type="button" class="btn btn-ghost-primary rounded-0 d-md-block" data-bs-toggle="modal" data-bs-target="#details-{{ $record->id }}">Details</button>
                </div>
            </div>
        @endif
        <div class="order-1 order-md-2 flex-grow-1 max-width-780">
            <a href="{{ $record->url }}" target="_blank" rel="noopener noreferrer" class="underline-on-hover text-success">
                <h2 class="h4 mb-2">{{ $record->name }}</h2>
            </a>
            <div class="h6 mt-3 text-uppercase text-body-emphasis">
                <span>{{ \Carbon\Carbon::parse($record->date)->format('M, d, Y') }}</span>
                @if(!$hideSource)
                    <span class="mx-2">/</span>
                    <a href="{{ route('discover.podcasts.show', $record->source->slug) }}">{{ $record->source->name }}</a>
                @endif
            </div>
            @if($record->summary)
                <div class="text-break my-2">{{ $record->summary }}</div>
            @endif
            @if($record->focus->count() > 0)
                <div class="d-flex flex-wrap align-items-center lead">
                    @foreach($record->focus as $focus)
                        <span class="me-2 mt-3 mb-2 badge bg-body-tertiary text-body-emphasis">{{ $focus->name }}</span>
                    @endforeach
                </div>
            @endif
            @if($record->companies->count() > 0 OR $record->people->count() > 0)
                <div class="d-flex flex-wrap align-items-center justify-content-start">
                    @foreach($record->companies as $company)
                        <x-entities.related.company-logo :company="$company" />
                    @endforeach
                    @foreach($record->people as $person)
                        <x-entities.related.person-photo :person="$person" />
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <div>
        <div wire:ignore.self class="modal fade" id="details-{{ $record->id }}" tabindex="-1" aria-labelledby="details-label-details-{{ $record->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary-subtle align-items-start">
                        <h3 class="modal-title h5 mb-0 mt-1" id="details-label-details-{{ $record->id }}">
                            <span class="truncate-600">{{ $record->name }}</span>
                        </h3>
                        <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>{!! $record->content !!}</div>
                        <div class="mt-3">
                            <a href="{{ $record->url }}" target="_blank" rel="noopener noreferrer" class="btn btn-accent text-white btn-lg">Listen Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
