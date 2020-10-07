<div class="position-relative p-3 p-md-5 text-center home-hero shadow-sm">
    <div class="col-md-10 col-lg-8 mx-auto my-5 text-center">
        <h1 class="hero-title font-weight-normal mt-2 col-lg-8 mx-auto mb-2">Clear data to build the future of psychedelics.</h1>
        <form class="search-form form-inline mx-auto justify-content-center" method="post" action="{{ route('search') }}">
            @csrf
            <input class="form-control hero-search-input shadow-sm search-field js-global-search-input" name="search" type="search" placeholder="Discover organizations, people, research..." aria-label="Search">
            <button class="btn hero-search-button ml-2 my-2 my-sm-0 shadow-sm" type="submit">Search</button>
        </form>
        <p class="mt-2" style="font-size: 1.5rem;font-weight: 600">
            <a href="{{ route('discover.organizations') }}" class="text-dark text-decoration-none border-bottom-dark-heavy {{-- bold-link --}}">Or start exploring our database...</a>
        </p>
    </div>
</div>
