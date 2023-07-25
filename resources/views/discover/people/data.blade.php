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
