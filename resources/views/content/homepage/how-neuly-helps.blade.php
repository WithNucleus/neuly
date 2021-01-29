<div class="home-card-container px-5 mx-auto my-5 pb-5">
    <div class="row">
        <div class="mt-3 col-12 text-center">
            <h2 class="h1 mb-0">How Neuly Can Help You</h2>
            <p class="lead mb-4">We've made complicated data and information easy to understand.</p>
        </div>
    </div>
    <div class="row d-flex flex-wrap">
        <div class="col-12 col-sm-6 col-lg-4 mb-5 pr-lg-5">
            <strong class="d-block h4 mb-1 border-bottom">Entrepreneurs <span class="float-right"><i class="fad fa-business-time text-secondarydark"></i></span></strong>
            <p class="mb-0">Find high-quality, low-cost solutions for your start up.</p>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 mb-5 pr-lg-5">
            <strong class="d-block h4 mb-1 border-bottom">Scientists <span class="float-right"><i class="fad fa-microscope text-secondarydark"></i></span></strong>
            <p class="mb-0">Share your findings with a dedicated network of experts.</p>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 mb-5 pr-lg-5">
            <strong class="d-block h4 mb-1 border-bottom">Investors <span class="float-right"><i class="fad fa-hands-usd text-secondarydark"></i></span></strong>
            <p class="mb-0">Stay up to date about company progress with alerts.</p>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 mb-5 pr-lg-5">
            <strong class="d-block h4 mb-1 border-bottom">Educators <span class="float-right"><i class="fad fa-books text-secondarydark"></i></span></strong>
            <p class="mb-0">Provide your students with the most relevant information.</p>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 mb-5 pr-lg-5 mb-lg-0">
            <strong class="d-block h4 mb-1 border-bottom">Researchers <span class="float-right"><i class="fad fa-business-time text-secondarydark"></i></span></strong>
            <p class="mb-0">Stop hunting for information across multiple platforms.</p>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 mb-5 pr-lg-5 mb-lg-0">
            <strong class="d-block h4 mb-1 border-bottom">Students <span class="float-right"><i class="fad fa-graduation-cap text-secondarydark"></i></span></strong>
            <p class="mb-0">Access a deep database of resources.</p>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 mb-5 pr-lg-5 mb-lg-0">
            <strong class="d-block h4 mb-1 border-bottom">Policy Makers <span class="float-right"><i class="fad fa-landmark text-secondarydark"></i></span></strong>
            <p class="mb-0">Understand industry data to help you make informed decisions.</p>
        </div>
    </div>
    @guest
        <div class="row">
            <div class="col">
                <p class="text-center">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Join Neuly</a>
                </p>
            </div>
        </div>
    @endguest
</div>
