<div class="row">
	<div class="col-12 col-md-8 col-lg-7">
        @if($company->website != '')
            <p class="mb-2 lead">
                <a href="{{ $company->website }}" target="_blank" rel="noopener noreferrer">{{ $company->website }}</a>
            </p>
        @endif

        @if($company->ownership != '')
            <p class="mb-2">
                <strong>Type:</strong><br>
                {{ $company->ownership }}
            </p>
        @endif

        <p class="mb-2">
            <strong>Focus:</strong><br>
            @foreach ($company->focus as $item)
                <a href="{{ route('discover.focus.show', $item->slug) }}">{{ $item->name }}</a>@if (!$loop->last),@endif
            @endforeach
        </p>
	</div>
	<div class="col-12 col-md-4 col-lg-5">
		<div class="text-center">
            @if($company->entityImageUrl)
                <img src="{{ $company->entityImageUrl }}" alt="{{ $company->name }}" class="company-logo mb-4">
            @else
                <img src="{{ asset('images/image-placeholder.jpg') }}" alt="{{ $company->name }}" class="company-logo mb-4">
            @endif

            <div class="d-flex flex-wrap align-items-center justify-content-center">
                @if ($company->linkedin)
                    <a href="https://www.linkedin.com/in/{{ $company->linkedin }}" target="_blank" rel="noopener noreferrer" class="mx-1 mb-2"><i class="fab fa-linkedin fa-2x"></i></a>
                @endif
                @if ($company->instagram)
                    <a href="https://www.instagram.com/{{ $company->instagram }}" target="_blank" rel="noopener noreferrer" class="mx-1 mb-2"><i class="fab fa-instagram fa-2x"></i></a>
                @endif
                @if ($company->facebook)
                    <a href="https://www.facebook.com/{{ $company->facebook }}" target="_blank" rel="noopener noreferrer" class="mx-1 mb-2"><i class="fab fa-facebook fa-2x"></i></a>
                @endif
            </div>
        </div>
	</div>
</div>

<div class="row my-4">
	<div class="col-12">
        <div style="max-width: 700px">
            @if($company->summary != '')
                <p>
                    <strong>Summary:</strong><br>
                    {{ $company->summary }}
                </p>
            @endif
        </div>
	</div>
</div>

<div class="row">
    <div class="col-12">
        @if($company->companyBranches->count() > 0)
            <div class="row mb-2">
                <div class="col-12">
                    <strong>Locations:</strong>
                </div>
                @foreach ($company->companyBranches as $branch)
                    <?php
                    $address = '';

                    if ($branch->address != '') {
                        $address .= $branch->address;
                    }

                    if ($branch->address2 != '') {
                        $address .= " " . $branch->address2;
                    }

                    if ($branch->location) {
                        $address .= "<br>" . $branch->location->name;
                    } else {
                        if ($branch->city != '') {
                            $address .= "<br>" . $branch->city;
                        }

                        if ($branch->state != '') {
                            $address .= " " . $branch->state;
                        }

                        if ($branch->zip != '') {
                            $address .= " " . $branch->zip;
                        }
                    }

                    $addressForGoogle = str_replace(',', '', $address);
                    $addressForGoogle = str_replace('<br>', '+', $addressForGoogle);
                    $addressForGoogle = str_replace(' ', '+', $addressForGoogle);
                    ?>

                    <div class="col-12 col-md-6 col-lg-4 mb-2 pr-3">
                        <address class="mb-1">
                            <a href="https://google.com/maps/place/{{ $addressForGoogle }}" target="_blank" rel="noopener noreferrer">{!! $address !!}</a>
                        </address>
                        @if ($branch->phone != '')
                            <span class="d-block">
                                <a href="tel:{{ $branch->phone }}"><i class="fa fa-phone-square-alt mr-1 text-primary"></i>{{ $branch->phone }}</a>
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            @if($company->locations->count() > 0)
                <p class="mb-2">
                    <strong>Location:</strong><br>
                    @foreach ($company->locations as $location)
                        <a href="{{ route('discover.locations.show', $location->slug) }}">{{ $location->name }}</a> @if (!$loop->last)<br>@endif
                    @endforeach
                </p>
            @endif
        @endif
    </div>
    <div class="col-12">
        @if($company->people->count() > 0)
            <p class="mb-2">
                <strong>People:</strong><br>
                @foreach ($company->people as $person)
                    <a href="{{ route('discover.people.show', $person->slug) }}">{{ $person->name }} ({{ $person->pivot->position }})</a> @if (!$loop->last)<br>@endif
                @endforeach
            </p>
        @endif

        @if($company->investors->count() > 0)
            <p class="mb-2">
                <strong>Investors:</strong><br>
                @foreach ($company->investors as $investor)
                    <a href="{{ route('discover.investors.show', $investor->slug) }}">{{ $investor->name }}</a> @if (!$loop->last)<br>@endif
                @endforeach
            </p>
        @endif

        @if($company->jobs->count() > 0)
            <p class="mb-2">
                <strong>Jobs:</strong><br>
                @foreach ($company->jobs as $job)
                    <a href="{{ route('discover.jobs.show', $job->slug) }}">{{ $job->job_title }}</a> @if (!$loop->last)<br>@endif
                @endforeach
            </p>
        @endif

        @if($company->events->count() > 0)
            <p class="mb-2">
                <strong>Events:</strong><br>
                @foreach ($company->events as $event)
                    <a href="{{ route('discover.events.show', $event->slug) }}">{{ $event->name }}</a> @if (!$loop->last)<br>@endif
                @endforeach
            </p>
        @endif

        @if($company->clinicaltrials->count() > 0)
            <p class="mb-1">
                <strong>Clinical Trials:</strong>
            </p>
            <ul class="list-group list-group-flush">
                @foreach ($company->clinicaltrials as $clinicaltrial)
                    <li class="list-group-item px-0 py-1">
                        <a class="d-block" href="{{ route('discover.clinicaltrials.show', $clinicaltrial->slug) }}">{{ $clinicaltrial->title }}</a>
                    </li>
                @endforeach
            </ul>
        @endif

        @if($company->subsidiaries->count() > 0)
            <div class="mt-4">
                <h2 class="h4 mb-2">Parent for:</h2>
                @foreach ($company->subsidiaries as $subsidiary)
                    <p class="mb-2"><a href="{{ route('discover.organizations.show', $subsidiary->slug) }}">{{ $subsidiary->name }}</a></p>
                @endforeach
            </div>
        @endif

        @if($company->parents->count() > 0)
            <div class="mt-4">
                <h2 class="h4 mb-2">Subsidiary of:</h2>
                @foreach ($company->parents as $parent)
                    <p class="mb-2"><a href="{{ route('discover.organizations.show', $parent->slug) }}">{{ $parent->name }}</a> </>
                @endforeach
            </div>
        @endif
    </div>
</div>

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

        @if($company->ticker_symbol != '')
            <p class="mb-2">
                <strong>Ticker Symbol:</strong><br>
                {{ $company->ticker_symbol }}
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
