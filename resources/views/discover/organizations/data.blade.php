<div class="row">
	<div class="col-12 col-md-8 col-lg-7">
        <p class="h5 text-body-emphasis">
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
                <a href="{{ route('discover.locations.show', $company->locations->first()->slug) }}" class="text-decoration-none text-body-secondary">
                    <i class="fa-sharp fa-solid fa-location-dot me-2"></i>{{ $company->locations->first()->name }}
                </a>
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
            <div class="logo-is-contained mb-3" style="background-image: url('{{ $company->entityImageUrl ?? asset('images/image-placeholder-research.png') }}')"></div>

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

@if($company->total_funding_amount != '' OR $company->last_funding_date != '' OR $company->valuation != '' OR $company->founded_date != '' OR $company->number_employees != '')
    <div class="row">
        @if($company->total_funding_amount != '')
            <x-entities.entity-show-data-card title="Total Funding Amount">
                ${{ number_format($company->total_funding_amount, 0) }}
            </x-entities.entity-show-data-card>
        @endif

        @if($company->last_funding_date != '')
            <x-entities.entity-show-data-card title="Last Funding Date">
                {{ Carbon\Carbon::parse($company->last_funding_date)->format('M d, Y') }}
            </x-entities.entity-show-data-card>
        @endif

        @if($company->valuation != '')
            <x-entities.entity-show-data-card title="Valuation">
                ${{ number_format($company->valuation, 0) }}
            </x-entities.entity-show-data-card>
        @endif

        @if($company->founded_date != '')
            <x-entities.entity-show-data-card title="Founded">
                {{ Carbon\Carbon::parse($company->founded_date)->format('M d, Y') }}
            </x-entities.entity-show-data-card>
        @endif

        @if($company->number_employees != '')
            <x-entities.entity-show-data-card title="Employees">
                {{ $company->number_employees }}
            </x-entities.entity-show-data-card>
        @endif
    </div>
@endif

@if($company->courses->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="coursesList" label="Courses">
        @foreach ($company->courses as $course)
            <x-entities.related.course-card :course="$course" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($company->bookableListings->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="bookableList" label="Book with {{ $company->name }}">
        @foreach ($company->bookableListings as $bookableListing)
            <x-entities.related.bookable-listing-card :bookableListing="$bookableListing" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($company->investors->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="investorsList" label="Investors">
        @foreach ($company->investors as $investor)
            <x-entities.related.investor-card :investor="$investor" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($company->people->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="peopleList" label="People">
        @foreach ($company->people as $person)
            <x-entities.related.person-card :person="$person" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($company->jobs->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="jobsList" label="Jobs">
        @foreach ($company->jobs as $job)
            <x-entities.related.job-card :job="$job" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($company->events->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="eventsList" label="Events">
        @foreach ($company->events as $event)
            <x-entities.related.event-card :event="$event" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($company->clinicaltrials->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="clinicalTrialsList" label="Clinical Trials">
        @foreach ($company->clinicaltrials as $clinicalTrial)
            <x-entities.related.clinical-trial-card :clinicalTrial="$clinicalTrial" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($company->locations->count() > 1 AND $company->bookableListings->count() < 1)
    <div class="my-4">
        <h3 class="mb-0">Locations</h3>
        @if($company->companyBranches->count() > 0)
            <div class="row">
                @foreach ($company->companyBranches as $branch)
                    <x-entities.related.company-branch-card :companyBranch="$branch" />
                @endforeach
            </div>
        @else
            <div class="w-auto d-flex">
                <ul class="list-group list-group-flush lead me-auto w-auto">
                    @foreach ($company->locations as $location)
                        <x-entities.related.location-list-item :location="$location" />
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endif

@if($company->subsidiaries->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="subsidiariesList" label="Subsidiaries">
        @foreach ($company->subsidiaries as $subsidiary)
            <x-entities.related.company-subsidiary-card :subsidiary="$subsidiary" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif

@if($company->parents->count() > 0)
    <x-entities.collapsable-related-entity collapsableId="parentsList" label="Subsidiary of">
        @foreach ($company->parents as $parent)
            <x-entities.related.company-parent-card :parent="$parent" />
        @endforeach
    </x-entities.collapsable-related-entity>
@endif
