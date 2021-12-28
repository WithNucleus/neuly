<div class="row">
	<div class="col-12 col-md-8 col-lg-7">

        @if($person->job_type)
            <p class="mb-2">
                <strong>Job type:</strong><br>
                {{ $person->job_type }}
            </p>
        @endif

        @if($person->byline)
            <p class="mb-2">
                <strong>Byline:</strong><br>
                {{ $person->byline }}
            </p>
        @endif

        @if($person->website != '')
            <p class="mb-2">
                <strong>Website:</strong><br>

                <a href="{{ $person->website }}" target="_blank" rel="noopener noreferrer">
                    {{ $person->website }} <i class="fad fa-external-link fa-xs"></i>
                </a>
            </p>
        @endif

        @if($person->google_scholar != '')
            <p class="mb-2">
                <a href="{{ $person->google_scholar }}" target="_blank" rel="noopener noreferrer">
                    Google Scholar <i class="fad fa-external-link fa-xs"></i>
                </a>
            </p>
        @endif

        @if($person->companies->count() > 0)
            <p class="mb-2">
                <strong>Organizations:</strong><br>
                @foreach ($person->companies as $company)
                    <a href="{{ route('discover.organizations.show', $company->slug) }}">{{ $company->name }} ({{ $company->pivot->position }})</a> @if (!$loop->last)<br>@endif
                @endforeach
            </p>
        @endif

        @if($person->investors->count() > 0)
            <p class="mb-2">
                <strong>Investors:</strong><br>

                @foreach ($person->investors as $investor)
                    <a href="{{ route('discover.investors.show', $investor->slug) }}">{{ $investor->name }} <span class="text-dark">({{ $investor->pivot->role }})</span></a>

                    @if (!$loop->last)<br>@endif
                @endforeach
            </p>
        @endif

        @if($person->locations->count() > 0)
            <p class="mb-2">
                <strong>Location:</strong><br>
                @foreach ($person->locations as $location)
                    <a href="{{ route('discover.locations.show', $location->slug) }}">{{ $location->name }}</a>@if (!$loop->last)<br>@endif
                @endforeach
            </p>
        @endif

        @if($person->research->count() > 0)
            <p class="mb-0 mt-4 h5">Research:</p>
            <ul class="list-group list-group-flush">
                @foreach ($person->research as $item)
                    <li class="list-group-item px-0 py-1">
                        <a class="d-block" href="{{ route('discover.research.show', $item->slug) }}">{{ $item->name }}</a>
                    </li>
                @endforeach
            </ul>
        @endif

        @if($person->clinicaltrials->count() > 0)
            <p class="mb-0 mt-4 h5">Clinical Trials:</p>
            <ul class="list-group list-group-flush">
                @foreach ($person->clinicaltrials as $clinicaltrial)
                    <li class="list-group-item px-0 py-1">
                        <a class="d-block" href="{{ route('discover.clinicaltrials.show', $clinicaltrial->slug) }}">{{ $clinicaltrial->title }}</a>
                    </li>
                @endforeach
            </ul>
        @endif

        @if($person->events->count() > 0)
            <p class="mb-0 mt-4 h5">Events:</p>
            <ul class="list-group list-group-flush">
                @foreach ($person->events as $event)
                    <li class="list-group-item px-0 py-1">
                        <a class="d-block" href="{{ route('discover.events.show', $event->slug) }}">{{ $event->name }}</a>
                    </li>
                @endforeach
            </ul>
        @endif

        @if($person->focus->count() > 0)
            <p class="mb-2">
                <strong>Focus:</strong><br>
                @foreach ($person->focus as $focus)
                    <a href="{{ route('discover.focus.show', $focus->slug) }}">{{ $focus->name }}</a>@if (!$loop->last)<br>@endif
                @endforeach
            </p>
        @endif

        @if($person->bio != '')
            <p class="mb-0">
                <strong>Bio:</strong>
            </p>
            {!! $person->bio !!}
        @endif

	</div>
	<div class="col-12 col-md-4 col-lg-5 text-center">
        @if($person->entityImageUrl)
            <div class="person-photo-large shadow-sm" style="background-image: url('{{ $person->entityImageUrl }}');">
                <span class="sr-only">{{ $person->name }}</span>
            </div>
        @else
            <img src="{{ asset('images/person-blank.png') }}" class="person-photo-large shadow-sm" alt="{{ $person->name }}">
        @endif

        <p class="text-center">
            @if ($person->linkedin)
                <a href="https://www.linkedin.com/in/{{ $person->linkedin }}" target="_blank" rel="noopener noreferrer" class="mx-1"><i class="fab fa-linkedin fa-2x"></i></a>
            @endif
            @if ($person->twitter)
                <a href="https://www.twitter.com/{{ $person->twitter }}" target="_blank" rel="noopener noreferrer" class="mx-1"><i class="fab fa-twitter fa-2x"></i></a>
            @endif
            @if ($person->facebook)
                <a href="https://www.facebook.com/{{ $person->facebook }}" target="_blank" rel="noopener noreferrer" class="mx-1"><i class="fab fa-facebook fa-2x"></i></a>
            @endif
            @if ($person->instagram)
                <a href="https://www.instagram.com/{{ $person->instagram }}" target="_blank" rel="noopener noreferrer" class="mx-1"><i class="fab fa-instagram fa-2x"></i></a>
            @endif
        </p>
	</div>

    @foreach ($person->content as $entityContent)
        <div class="col-12 mb-3">
            <strong>{{ $entityContent->name }}</strong><br>
            {!! nl2br(e($entityContent->content)) !!}
        </div>
    @endforeach
</div>
