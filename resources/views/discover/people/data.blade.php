<div class="row">
	<div class="col-12 col-md-8 col-lg-7">
        @if($person->byline != '')
            <p class="h5 text-body-emphasis">{{ $person->byline }}</p>
        @endif

        @if($person->job_type)
            <div class="text-uppercase text-body-secondary mb-2">
                {{ $person->job_type }}
            </div>
        @endif

        @if($person->locations->count() === 1)
            <div class="mb-2 lead">
                <a href="{{ route('discover.locations.show', $person->locations->first()->slug) }}" class="text-decoration-none text-body-secondary">
                    <i class="fa-sharp fa-solid fa-location-dot me-2"></i>{{ $person->locations->first()->name }}
                </a>
            </div>
        @endif

        @if($person->website != '')
            <div class="lead mb-3">
                <a href="{{ $person->website }}" target="_blank" rel="noopener noreferrer">{{ $person->website }}</a>
            </div>
        @endif

        @if($person->focus->count() > 0)
            <div class="d-flex flex-wrap align-items-center mt-4">
                @foreach ($person->focus as $item)
                    <a href="{{ route('discover.focus.show', $item->slug) }}" class="btn btn-secondary rounded-0 my-2 me-3 fs-6 py-1">{{ $item->name }}</a>
                @endforeach
            </div>
        @endif

        @if($person->bio != '')
            <div class="lead my-3">
                @if ($person->show_extended_bio)
                    <div>
                        {!! $person->short_bio !!}
                        <button type="button" class="btn btn-link text-primary px-0" data-bs-toggle="modal" data-bs-target="#companySummaryModal">
                            read more
                        </button>

                        <div class="modal fade" id="companySummaryModal" tabindex="-1" aria-labelledby="companySummaryModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <p class="modal-title fs-5 m-0" id="companySummaryModalLabel">{{ $person->name }}</p>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="m-0">{!! $person->bio !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="m-0">{!! $person->bio !!}</p>
                @endif
            </div>
        @endif
    </div>
    <div class="col-12 col-md-4 col-lg-5">
		<div class="text-center">
            <div class="logo-square-is-contained rounded-circle mb-3" style="background-image: url('{{ $person->entityImageUrl ?? asset('images/person-blank.png') }}')"></div>

            <div class="d-flex flex-wrap align-items-center justify-content-center">
                @if ($person->google_scholar)
                    <a href="{{ $person->google_scholar }}" target="_blank" rel="noopener noreferrer" class="m-2"><i class="fa-brands fa-google fa-2x"></i></a>
                @endif
                @if ($person->linkedin)
                    <a href="https://www.linkedin.com/in/{{ $person->linkedin }}" target="_blank" rel="noopener noreferrer" class="m-2"><i class="fa-brands fa-linkedin-in fa-2x"></i></a>
                @endif
                @if ($person->twitter)
                    <a href="https://www.twitter.com/{{ $person->twitter }}" target="_blank" rel="noopener noreferrer" class="m-2"><i class="fa-brands fa-twitter fa-2x"></i></a>
                @endif
                @if ($person->instagram)
                    <a href="https://www.instagram.com/{{ $person->instagram }}" target="_blank" rel="noopener noreferrer" class="m-2"><i class="fa-brands fa-instagram fa-2x"></i></a>
                @endif
                @if ($person->facebook)
                    <a href="https://www.facebook.com/{{ $person->facebook }}" target="_blank" rel="noopener noreferrer" class="m-2"><i class="fa-brands fa-facebook-f fa-2x"></i></a>
                @endif
            </div>
        </div>
	</div>
</div>

@if($person->locations->count() > 1)
    <div class="my-4">
        <h3 class="mb-0">Locations</h3>
        <div class="w-auto d-flex">
            <ul class="list-group list-group-flush lead me-auto w-auto">
                @foreach ($person->locations as $location)
                    <x-entities.related.location-list-item :location="$location" />
                @endforeach
            </ul>
        </div>
    </div>
@endif

<?php // TODO: Make these look nicer ?>
@if($person->mediaItems->count() > 1)
    <x-entities.collapsable-related-entity collapsableId="mediaList" label="Articles / Podcasts / Other Media">
        @foreach ($person->mediaItems as $mediaItem)
            <div class="col-12 col-md-6 col-xl-4 mb-4">
                <x-entities.entity-logo-card url="" linkClasses="py-1 text-start d-flex flex-column justify-content-between">
                    <div>
                        <div class="h6 fw-bold text-uppercase mb-3">{{ $mediaItem->name }}</div>

                        @if ($mediaItem->summary)
                            <div class="my-3 text-body">
                                {{ $mediaItem->short_summary }}
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="text-uppercase me-2 d-flex align-items-center">
                            @if($mediaItem->icon_url)
                                <img src="{{ $mediaItem->icon_url }}" alt="{{ $mediaItem->name }}" width="30" height="30" />
                            @else
                                <div class="h4 mb-0 text-accent">{!! $mediaItem->media_icon !!}</div>
                            @endif
                            <span class="text-secondary ms-2">
                                {{ $mediaItem->media_type }}
                            </span>
                        </div>
                        <div class="text-secondary text-uppercase">{{ $mediaItem->formatted_date }}</div>
                    </div>

                </x-entities.entity-logo-card>
            </div>
        @endforeach
    </x-entities.collapsable-related-entity>
@endif


@if($person->bookableListings->count() > 0)
    <?php // TODO: If only 1 -- don't have the collapsable thing -- just pull the data from there ?>
    <x-entities.collapsable-related-entity collapsableId="bookableList" label="Book with {{ $person->name }}">
        @foreach ($person->bookableListings as $bookableListing)
            <x-entities.related.bookable-listing-card :bookableListing="$bookableListing" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@foreach ($person->content as $content)
    <div class="col-12 col-lg-7 mb-3">
        <div class="h6 text-uppercase">{{ $content->name }}</div>
        {!! $content->formattedContent !!}
    </div>
@endforeach

@if($person->companies->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="companiesList" label="Organizations">
        @foreach ($person->companies as $company)
            <x-entities.related.company-card :company="$company" pivot="position" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($person->investors->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="investorsList" label="Investors">
        @foreach ($person->investors as $investor)
            <x-entities.related.investor-card :investor="$investor" pivot="role" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($person->events->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="eventsList" label="Events">
        @foreach ($person->events as $event)
            <x-entities.related.event-card :event="$event" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($person->clinicaltrials->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="clinicalTrialsList" label="Clinical Trials">
        @foreach ($person->clinicaltrials as $clinicalTrial)
            <x-entities.related.clinical-trial-card :clinicalTrial="$clinicalTrial" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($person->research->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="researchList" label="Research">
        @foreach ($person->research as $research)
            <x-entities.related.research-card :research="$research" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

<!-- MORE RELATIONSHIPS -->
