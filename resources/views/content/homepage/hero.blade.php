<div class="position-relative py-3 py-md-5 text-center home-hero">
    <div class="container-fluid">
        <h1 class="hero-title mt-5 mx-auto mb-5">
            All the Data, Tools, and Care <span>in One <strong style="color: #454a91">Psychedelic Platform</strong></span>
        </h1>
        <div class="d-lg-flex justify-content-center">
            <div class="col-12 col-lg-6 pl-lg-0">
                <div class="text-center text-lg-right">
                    <div id="home-hero-image" class="mx-auto mr-lg-0 mb-3 mb-lg-0">
                        <img src="{{ asset('images/home-clinical-trial-tracker.png') }}" alt="Clinical Trial Tracker on Neuly" id="first-hero-image" class="active-hero-image">
                        <img src="{{ asset('images/home-insights.png') }}" alt="Neuly Insights - Analysis on the Psychedelics Industry">
                        <img src="{{ asset('images/home-investors.png') }}" alt="Neuly's list of investors in the psychedelics industry">
                        <img src="{{ asset('images/home-research.png') }}" alt="Neuly's list of research in the psychedelics industry">
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 pr-lg-0">
                <div class="homepage-bullets-container text-left">
                    <h2 class="homepage-bullets-title mt-xl-3">Your One-Stop Connection to Psychedelics</h2>
                    <ul class="homepage-bullets-list">
                        <li class="homepage-bullets pt-2 pb-2">Our technology collects and analyzes data so that you don't have to</li>
                        <li class="homepage-bullets pt-2 pb-2">Our team researches industry updates to keep you in the know</li>
                        <li class="homepage-bullets pt-2 pb-2">Leverage tools that can be customized for your business</li>
                        <li class="homepage-bullets pt-2 pb-2">Find and book clinics, therapists, coaches, and retreats</li>
                        <li class="homepage-bullets pt-2 pb-2">Connect with industry professionals to help grow the industry</li>
                    </ul>
                    <p class="text-center text-lg-left ml-lg-3">
                        <a href="{{ route('register') }}" class="btn btn-dark btn-lg btn-xl mr-3">Signup</a>
                        <a href="{{ route('feedback.request-demo') }}" class="btn btn-primary btn-lg btn-xl">Request Data</a>
                    </p>
                    <p class="text-center lead text-lg-left ml-lg-3">
                        <a href="{{ route('about') }}" class="text-dark font-weight-bold">Or learn more about Neuly</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
