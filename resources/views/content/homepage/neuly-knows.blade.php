<div class="container py-3 mt-5 mb-5">

    <div class="row mb-3">
        <div class="col text-center">
            <h2 class="font-normal h1 text-uppercase hero-subtitle">Neuly <em>knows</em> psychedelics</h2>
            <p class="lead-larger">Transparent data and insights, to make better informed decisions.</p>
        </div>
    </div>

    <div class="neuly-knows row d-flex align-items-start justify-content-center flex-wrap flex-column flex-md-row">
        <div class="nk-item text-center col-12 col-md">
            <a href="{{ route('discover.organizations') }}" class="text-decoration-none">
                        <span class="counters d-block text-primary title mb-0">
                            @isset($count_companies)
                                {{ $count_companies }}
                            @else
                                526
                            @endisset
                        </span>
                <span class="d-block lead">Organizations</span>
            </a>
        </div>
        <div class="nk-item text-center col-12 col-md">
            <a href="{{ route('discover.people') }}" class="text-decoration-none">
                        <span class="counters d-block text-primary title mb-0">
                            @isset($count_people)
                                {{ $count_people }}
                            @else
                                604
                            @endisset
                        </span>
                <span class="d-block lead">People</span>
            </a>
        </div>
        <div class="nk-item text-center col-12 col-md">
            <a href="{{ route('discover.investors') }}" class="text-decoration-none">
                        <span class="counters d-block text-primary title mb-0">
                            @isset($count_investors)
                                {{ $count_investors }}
                            @else
                                42
                            @endisset
                        </span>
                <span class="d-block lead">Investors</span>
            </a>
        </div>
        <div class="nk-item text-center col-12 col-md">
            <a href="{{ route('discover.locations') }}" class="text-decoration-none">
                        <span class="counters d-block text-primary title mb-0">
                            @isset($count_locations)
                                {{ $count_locations }}
                            @else
                                210
                            @endisset
                        </span>
                <span class="d-block lead">Locations</span>
            </a>
        </div>
        <div class="nk-item text-center col-12 col-md">
            <a href="{{ route('discover.clinicaltrials') }}" class="text-decoration-none">
                        <span class="counters d-block text-primary title mb-0">
                            @isset($count_clinicaltrials)
                                {{ $count_clinicaltrials }}
                            @else
                                1268
                            @endisset
                        </span>
                <span class="d-block lead">Clinical Trials</span>
            </a>
        </div>
    </div>
</div>
