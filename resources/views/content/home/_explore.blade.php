<div class="home-explore bg-body">
    <div class="container-fluid text-center">
        <div class="position-relative max-width-1000 mx-auto">
            <div class="rounded-4 bg-accent px-4 py-4 pb-0 d-flex flex-column flex-lg-row">
                <div class="healthy-doctor-text">
                    <h3 class="h2 text-tertiary">Become 'Brain Healthy'</h3>
                    <p class="text-dark">We're creating a world where every human can be more well through stronger access to critical health data.</p>
                    @auth
                        <a href="{{ route('member.dashboard') }}" class="btn btn-light btn-cta text-transform-none">View Your Dashboard</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-light btn-cta text-transform-none">Register for Neuly</a>
                    @endif
                </div>
                <div class="healthy-doctor-image">
                    <img src="{{ asset('images/home/brain-healthy-doctors.png') }}" alt="Become 'brain healthy' with Neuly">
                </div>
            </div>
        </div>
        <div class="mt-5 pt-5">
            <div class="max-width-400 mx-auto mb-4">
                @include('navbars.neuly-research-logo')
            </div>
            <h2 class="h1 text-body-emphasis">Explore the Latest Psychedelic Research</h2>
            <div class="d-flex flex-wrap justify-content-center">
                @foreach($research as $item)
                    <div class="max-width-300 bg-body-secondary p-3 rounded text-start m-3">
                        <a href="{{ route('discover.research.show', $item->slug) }}" class="text-decoration-none research-item h-100">
                            <div>
                                <p class="lead text-body-emphasis mb-2">{{ $item->name }}</p>
                                <p class="mb-2 text-body-secondary">{{ $item->abstract }}</p>
                            </div>
                            <div>
                                <div>
                                    @foreach($item->focus as $focus)
                                        <span class="badge bg-body-tertiary text-body me-1">{{ $focus->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                <a href="{{ route('discover.research') }}" class="btn btn-primary btn-lg btn-cta">View More Research</a>
            </div>
        </div>
    </div>
</div>
