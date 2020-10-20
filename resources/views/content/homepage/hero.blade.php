{{--<div class="position-relative p-3 p-md-5 text-center home-hero shadow-sm">--}}
{{--    <div class="col-md-10 col-lg-8 mx-auto my-5 text-center">--}}
{{--        <h1 class="hero-title font-weight-normal mt-2 col-lg-8 mx-auto mb-2">Clear data to build the future of psychedelics.</h1>--}}
{{--        <form class="search-form form-inline mx-auto justify-content-center" method="post" action="{{ route('search') }}">--}}
{{--            @csrf--}}
{{--            <input class="form-control hero-search-input shadow-sm search-field js-global-search-input" name="search" type="search" placeholder="Discover organizations, people, research..." aria-label="Search">--}}
{{--            <button class="btn hero-search-button ml-2 my-2 my-sm-0 shadow-sm" type="submit">Search</button>--}}
{{--        </form>--}}
{{--        <p class="mt-2" style="font-size: 1.5rem;font-weight: 600">--}}
{{--            <a href="{{ route('member.dashboard') }}" class="text-dark text-decoration-none border-bottom-dark-heavy">Or start exploring our database...</a>--}}
{{--        </p>--}}
{{--    </div>--}}
{{--    <div class="col-12 col-lg-10">--}}
{{--        <img src="{{ asset('images/home-clinical-trial-tracker.png') }}" alt="" style="max-width: 600px;height: auto;">--}}
{{--    </div>--}}
{{--</div>--}}


<div class="position-relative p-3 p-md-5 text-center home-hero shadow-sm">
    <div class="container-fluid">
        <h1 class="hero-title font-weight-normal mt-5 col-lg-8 mx-auto mb-5">Clear data to build the future of psychedelics.</h1>
{{--        <h2 class="font-normal">Neuly collects and analyzes data across the psychedelic industry, providing you with transparent information and proprietary insights.</h2>--}}
{{--        <img src="{{ asset('images/home-clinical-trial-tracker.png') }}" alt="" style="width: 100%;max-width: 800px;height: auto;">--}}
        <div class="row mb-5">
            <div class="col-12 col-md-5 col-lg-6 text-md-right pr-md-5">
                <img src="{{ asset('images/home-clinical-trial-tracker.png') }}" alt="" style="width: 100%;max-width: 600px;height: auto;">
            </div>
            <div class="col-12 col-md-7 col-lg-6 text-left">
                <h2 class="mt-xl-5 h4 font-normal font-weight-normal">Data &amp; Insights for the Psychedelics Industry</h2>
                <ul>
                    <li class="lead pt-2 pb-2">Neuly collects and analyzes the mountains of data</li>
                    <li class="lead pt-2 pb-2">You browse our extensive database and insights</li>
                    <li class="lead pt-2 pb-2">We all work together to grow the psychedelics industry</li>
                </ul>
                <p class="ml-md-3">
                    <a href="{{ route('member.dashboard') }}" class="btn btn-dark btn-lg">Start exploring our database...</a>
                </p>
                <p class="ml-md-3">
                    <a href="{{ route('about') }}" class="text-dark">Or learn more about Neuly</a>
                </p>
            </div>
        </div>
    </div>
</div>
