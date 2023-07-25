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
                                <img src="{{ $mediaItem->icon_url }}" alt="{{ $mediaItem->name }}" width="30" height="30" class="img-height-30" />
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
