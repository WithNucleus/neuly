<div class="row">
	<div class="col-12 col-md-8 col-lg-7">
        <p class="h5 text-body-secondary">
            {{ $company->ownership_type_phrase }}
            @if($company->ticker_symbol != '')
                &bull; {{ $company->ticker_symbol }}
            @endif
        </p>

        @if($company->summary != '')
            <div class="lead my-3">
                @if ($company->show_extended_summary)
                    <div>
                        {{ $company->short_summary }}
                        <button type="button" class="btn btn-link text-primary px-0" data-bs-toggle="modal" data-bs-target="#companySummaryModal">
                            read more
                        </button>

                        <div class="modal fade" id="companySummaryModal" tabindex="-1" aria-labelledby="companySummaryModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <p class="modal-title fs-5 m-0" id="companySummaryModalLabel">{{ $company->name }}</p>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="m-0">{{ $company->summary }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="m-0">{{ $company->summary }}</p>
                @endif
            </div>
        @endif

        @if($company->locations->count() === 1)
            <div class="mb-2 lead">
                <a href="{{ route('discover.locations.show', $company->locations->first()->slug) }}" class="text-decoration-none text-secondary"><i class="fa-sharp fa-solid fa-location-dot me-2"></i>{{ $company->locations->first()->name }}</a>
            </div>
        @endif

        @if($company->website != '')
            <div class="lead mb-3">
                <a href="{{ $company->website }}" target="_blank" rel="noopener noreferrer">{{ $company->website }}</a>
            </div>
        @endif

        @if($company->focus->count() > 0)
            <div class="d-flex flex-wrap align-items-center mt-4">
                @foreach ($company->focus as $item)
                    <a href="{{ route('discover.focus.show', $item->slug) }}" class="btn btn-secondary rounded-0 my-2 me-3 fs-6 py-1">{{ $item->name }}</a>
                @endforeach
            </div>
        @endif
	</div>
	<div class="col-12 col-md-4 col-lg-5">
		<div class="text-center">
            <div class="logo-is-contained mb-3" style="background-image: url('{{ $company->entityImageUrl ?? asset('images/image-placeholder.jpg') }}')"></div>

            <div class="d-flex flex-wrap align-items-center justify-content-center">
                @if ($company->linkedin)
                    <a href="{{ $company->linkedin }}" target="_blank" rel="noopener noreferrer" class="mx-1 mb-2"><i class="fab fa-linkedin fa-2x"></i></a>
                @endif
                @if ($company->instagram)
                    <a href="{{ $company->instagram }}" target="_blank" rel="noopener noreferrer" class="mx-1 mb-2"><i class="fab fa-instagram fa-2x"></i></a>
                @endif
                @if ($company->facebook)
                    <a href="{{ $company->facebook }}" target="_blank" rel="noopener noreferrer" class="mx-1 mb-2"><i class="fab fa-facebook fa-2x"></i></a>
                @endif
            </div>
        </div>
	</div>
</div>

@if($company->bookableListings->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="bookableList" label="Book with {{ $company->name }}">
        @foreach ($company->bookableListings as $bookableListing)
            <div class="col-12 col-md-6 col-xl-4 mb-4">
                <x-entities.entity-logo-card url="{{ route('discover.bookable-listing.show', $bookableListing->slug) }}" linkClasses="py-3">
                    <div class="fw-bold text-uppercase m-0">{{ $bookableListing->name }}</div>
                    <div class="text-body m-0 w-100">
                        <div>
                            {!! $bookableListing->fullAddress !!}
                        </div>
                        <div>{{ $bookableListing->phone }}</div>
                    </div>
                </x-entities.entity-logo-card>
            </div>
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($company->investors->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="investorsList" label="Investors">
        @foreach ($company->investors as $investor)
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <x-entities.entity-logo-card url="{{ route('discover.investors.show', $investor->slug) }}">
                    <div class="logo-is-contained" style="background-image: url('{{ $investor->entityImageUrl ?? asset('images/image-placeholder.jpg') }}');"></div>
                    <p class="fw-bold text-uppercase m-0">{{ $investor->name }}</p>
                </x-entities.entity-logo-card>
            </div>
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($company->people->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="peopleList" label="People">
        @foreach ($company->people as $person)
            <div class="col-6 col-md-4 col-xl-3 mb-4">
                <x-entities.entity-logo-card url="{{ route('discover.people.show', $person->slug) }}" linkClasses="py-2">
                    <div class="logo-square-is-contained rounded-circle mb-1" style="background-image: url('{{ $person->entityImageUrl ?? asset('images/person-blank.png') }}');"></div>
                    <p class="fw-bold text-uppercase m-0">{{ $person->name }}</p>
                    <p class="text-body-secondary m-0">{{ $person->pivot->position }}</p>
                </x-entities.entity-logo-card>
            </div>
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($company->jobs->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="jobsList" label="Jobs">
        @foreach ($company->jobs as $job)
            <div class="col-12 col-lg-6 mb-4">
                <x-entities.entity-logo-card url="{{ route('discover.jobs.show', $job->slug) }}" linkClasses="py-2">
                    <p class="text-start fw-bold text-uppercase m-0">{{ $job->name }}</p>
                    <p class="text-start text-body-secondary m-0">
                        {{ $job->pretty_posted_date }}
                        &bull;
                        {{ $job->employment_type }}
                    </p>
                </x-entities.entity-logo-card>
            </div>
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($company->events->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="eventsList" label="Events">
        @foreach ($company->events as $event)
            <div class="col-6 col-md-4 col-xl-3 mb-4">
                <x-entities.entity-logo-card url="{{ route('discover.events.show', $event->slug) }}" linkClasses="py-2">
                    <div class="logo-is-contained mb-1" style="background-image: url('{{ $event->entityImageUrl ?? asset('images/image-placeholder.jpg') }}');"></div>
                    <p class="fw-bold text-uppercase m-0">{{ $event->name }}</p>
                    <p class="text-body-secondary m-0">{{ $event->pretty_start_date }}</p>
                </x-entities.entity-logo-card>
            </div>
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($company->clinicaltrials->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="clinicalTrialsList" label="Clinical Trials">
        @foreach ($company->clinicaltrials as $clinicalTrial)
            <div class="col-12 col-lg-6 mb-4">
                <x-entities.entity-logo-card url="{{ route('discover.clinicaltrials.show', $clinicalTrial->slug) }}" linkClasses="py-1 text-start">
                    <p class="fs-6 fw-bold text-uppercase m-0">{{ $clinicalTrial->name }}</p>
                    @if($clinicalTrial->conditions->count() > 0)
                        <div class="fs-6 mt-2 mb-3 text-body">
                            @foreach ($clinicalTrial->conditions as $item)
                                <div>{{ $item->value }}</div>
                            @endforeach
                        </div>
                    @endif
                    <div class="d-flex justify-content-start text-body-secondary mb-3">
                        @foreach ($clinicalTrial->focus as $focus)
                            <span class="badge bg-secondary text-uppercase">{{ $focus->name }}</span>
                        @endforeach
                    </div>
                    <div class="text-body-secondary d-flex flex-wrap">
                        <div class="me-3">
                            <strong>Start Date:</strong> {{ $clinicalTrial->pretty_start_date }}
                        </div>
                        <div>
                            <strong>Last Updated:</strong> {{ $clinicalTrial->pretty_last_update_posted }}
                        </div>
                    </div>
                </x-entities.entity-logo-card>
            </div>
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($company->locations->count() > 1 AND $company->bookableListings->count() < 1)
    <div class="my-4">
        <h3 class="mb-0">Locations</h3>
        @if($company->companyBranches->count() > 0)
            <div class="row">
                @foreach ($company->companyBranches as $branch)
                    <div class="col-12 col-md-6 col-xl-4 mb-3 lead">
                        <address class="mb-1">
                            <a href="https://google.com/maps/place/{!! $branch->fullAddressForGoogle !!}" class="text-decoration-none" target="_blank" rel="noopener noreferrer">{!! $branch->fullAddress !!}</a>
                        </address>
                        @if ($branch->phone != '')
                            <span class="d-block">
                                <a href="tel:{{ $branch->phone }}" class="text-decoration-none">
                                    <i class="fa-sharp fa-solid fa-square-phone me-1"></i>{{ $branch->phone }}
                                </a>
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="w-auto d-flex">
                <ul class="list-group list-group-flush lead me-auto w-auto">
                    @foreach ($company->locations as $location)
                        <li class="list-group-item px-0">
                            <a href="{{ route('discover.locations.show', $location->slug) }}">{{ $location->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endif

@if($company->subsidiaries->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="subsidiariesList" label="Subsidiaries">
        @foreach ($company->subsidiaries as $subsidiary)
            <div class="col-6 col-md-4 col-xl-3 mb-4">
                <x-entities.entity-logo-card url="{{ route('discover.organizations.show', $subsidiary->slug) }}" linkClasses="py-2">
                    <div class="logo-is-contained mb-1" style="background-image: url('{{ $subsidiary->entityImageUrl ?? asset('images/image-placeholder.jpg') }}');"></div>
                    <p class="fw-bold text-uppercase m-0">{{ $subsidiary->name }}</p>
                </x-entities.entity-logo-card>
            </div>
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($company->parents->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="parentsList" label="Subsidiary of">
        @foreach ($company->parents as $parent)
            <div class="col-6 col-md-4 col-xl-3 mb-4">
                <x-entities.entity-logo-card url="{{ route('discover.organizations.show', $parent->slug) }}" linkClasses="py-2">
                    <div class="logo-is-contained mb-1" style="background-image: url('{{ $parent->entityImageUrl ?? asset('images/image-placeholder.jpg') }}');"></div>
                    <p class="fw-bold text-uppercase m-0">{{ $parent->name }}</p>
                </x-entities.entity-logo-card>
            </div>
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

<div class="row my-4">
    <div class="col-12">
        @if($company->total_funding_amount != '')
            <p class="mb-2">
                <strong>Total Funding Amount:</strong><br>
                ${{ number_format($company->total_funding_amount, 0) }}
            </p>
        @endif

        @if($company->last_funding_date != '')
            <p class="mb-2">
                <strong>Last Funding Date:</strong><br>
                {{ Carbon\Carbon::parse($company->last_funding_date)->format('M d, Y') }}
            </p>
        @endif

        @if($company->latestValuationAmount)
            <p class="mb-2">
                <strong>Valuation:</strong><br>
                ${{ $company->latestValuationAmount }}
            </p>
        @endif

        @if($company->valuation != '')
            <p class="mb-2">
                <strong>Valuation:</strong><br>
                ${{ number_format($company->valuation, 0) }}
            </p>
        @endif

        @if($company->founded_date != '')
            <p class="mb-2">
                <strong>Founded:</strong><br>
                {{ Carbon\Carbon::parse($company->founded_date)->format('M d, Y') }}
            </p>
        @endif

        @if($company->number_employees != '')
            <p class="mb-2">
                <strong>Employees:</strong><br>
                {{ $company->number_employees }}
            </p>
        @endif
    </div>
</div>

<div class="row">
    @foreach ($company->content as $content)
        <div class="col-12 col-lg-7 mb-3">
            <strong>{{ $content->name }}</strong><br>
            {!! $content->formattedContent !!}
        </div>
    @endforeach
</div>
