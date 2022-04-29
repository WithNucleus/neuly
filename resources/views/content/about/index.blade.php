@extends('layouts.app')

@section('body-class', 'page-home bg-light')

@section('content')

    @include('navbars.primary')

    <main id="home-main" role="main">

        <div class="bg-neurons py-3 shadow-sm">
            <div class="container-fluid py-5">
                <h1 class="hero-title text-center mt-5 mx-auto mb-5">
                    All the Data, Tools, and Care
                    <span class="d-block">in One <strong style="color: #454a91">Psychedelic Platform</strong></span>
                </h1>
            </div>
        </div>

        <div class="container py-5">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h2 class="h1 page-title-default text-primary">What We Do</h2>
                    <p class="lead">
                        Neuly was created to provide transparent information for entrepreneurs, investors, researchers, scientists, educators, policy makers, and anyone interested in the psychedelics industry.
                    </p>
                    <p class="lead mb-0">
                        By presenting data in a non-biased manner, members of Neuly may utilize information to drive forward the projects that they are working on and make data based decisions.
                    </p>
                </div>
                <div class="col-12 col-md-6">
                    <img src="{{ asset('images/neuly-complex-map.png') }}" alt="Neuly" style="max-width: 400px">
                </div>
            </div>
        </div>

        <div class="bg-brains-dark shadow-sm py-5">
            <div class="container pb-5 pt-4">
                <div class="row">
                    <div class="col text-center">
                        <h3 class="h1 text-tertiary">Neuly, For You</h3>
                        <p class="lead text-white">We’ve made complicated data and information easy to understand. Here is how Neuly can help you:</p>
                    </div>
                </div>
                <div class="row pb-3 pt-2 px-3 bg-white shadow">
                    <div class="col-12 col-md-6 col-lg-4 pt-4">
                        <h4 class="text-quaternary d-flex justify-content-between align-items-baseline mb-1">Entrepreneurs <span class="float-right"><i class="fad fa-business-time text-primary"></i></span></h4>
                        <p>Find out where opportunities exist by looking for gaps in the market. Neuly can break down complicated data into simple information. Whether you need to hire someone, find investors, or connect with an industry expert, use Neuly's database to find what you're looking for.</p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 pt-4">
                        <h4 class="text-quaternary d-flex justify-content-between align-items-baseline mb-1">Investors <span class="float-right"><i class="fad fa-hands-usd text-secondarydark"></i></span></h4>
                        <p>Keep track of the companies you’ve invested in, find new opportunities you didn’t know about, and stay up to date with changes in the industry. In your member’s dashboard, you can set up alerts that will tell you when a company has reached certain benchmarks.</p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 pt-4">
                        <h4 class="text-quaternary d-flex justify-content-between align-items-baseline mb-1">Researchers <span class="float-right"><i class="fad fa-microscope text-primary"></i></span></h4>
                        <p>Looking for hard-to-find information to complete a report or project? Neuly has built tools that aggregate information from multiple sources and funnel everything into one location. Click through the tabs of Neuly’s database, then filter and sort different categories to find what you need. Bookmark, follow, and take notes about your findings, then export that information to wherever you need.</p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 pt-4">
                        <h4 class="text-quaternary d-flex justify-content-between align-items-baseline mb-1">Doctors & Scientists <span class="float-right"><i class="fad fa-stethoscope text-secondarydark"></i></span></h4>
                        <p>Trying to find an industry peer that can help you with your own studies? Neuly’s database includes the people from every company in the psychedelics industry so you know who to reach out to for help.</p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 pt-4">
                        <h4 class="text-quaternary d-flex justify-content-between align-items-baseline mb-1">Students & Educators <span class="float-right"><i class="fad fa-graduation-cap text-primary"></i></span></h4>
                        <p>Neuly’s database is free to access and easy to use. Whether you’re gathering information for a mid-term report or preparing a lesson plan, you can use Neuly’s dashboard to organize your personal research and then export your findings. </p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 pt-4">
                        <h4 class="text-quaternary d-flex justify-content-between align-items-baseline mb-1">Government Agents <span class="float-right"><i class="fad fa-landmark text-secondarydark"></i></span></h4>
                        <p>Neuly can help you understand what’s going on from inside the industry, allowing regulatory decisions to better align with market trends. You’ll also be able to get deeper insights by accessing Neuly’s proprietary cross referenced data sets.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-sm">
            <div class="container py-5">
                <h3 class="h1 text-center">Grow With Us</h3>
                <p>Neuly is an ongoing project that is constantly being updated and built. This will allow for an ever-growing source of information, as well as a deeper understanding of the neuroscience industry. As more data is compiled, Neuly will distribute industry insights by cross referencing datasets. This will give new perspectives on how the body’s neural network operates and how we, as humans, can become healthier and more productive people.</p>
            </div>
        </div>

        @guest
            <div class="bg-brains">
                <div class="container py-5">
                    <div class="row">
                        <div class="mx-auto col-12 col-md-8 col-lg-7">
                            <p class="lead text-white text-center">
                                Join today to get access to our extensive psychedelic database + your Neuly dashboard to follow &amp; save info, take notes, and more.
                            </p>
                        </div>
                    </div>
                    <p class="text-center mb-0">
                        <a href="{{ route('register') }}" class="btn btn-tertiary font-weight-bold btn-lg text-uppercase">Register</a>
                    </p>
                </div>
            </div>
        @else
            <div class="bg-brains">
                <div class="container py-5">
                    <div class="row">
                        <div class="mx-auto col-12 col-md-8 col-lg-7">
                            <p class="lead text-white text-center">
                                Thank you for being a member of Neuly! Let us know if you have any suggestions for new features or improving our website and tools.
                            </p>
                        </div>
                    </div>
                    <p class="text-center mb-0">
                        <a href="{{ route('feedback.create') }}" class="btn btn-tertiary font-weight-bold btn-lg text-uppercase">Contact Us</a>
                    </p>
                </div>
            </div>
        @endguest

        <div>
            <div class="container pt-5 pb-3">
                <h2 class="h1 text-center">Data, Information, Insights, For You</h2>
                <p>Neuly members get to use all available data and resources for their own needs, as well as receive custom insights on industry trends and developments.</p>
                <p>All original data within the Neuly platform has been sourced from public records and information that is publicly available. Neuly then takes that original data, which is compiled form multiple sources, and cross references all data sets to create unique insights. While we do encourage users to thoroughly review and utilize all available resources on Neuly, we do not give permission to republish, copy, and/or commercially utilize any content that is created or presented by Neuly without explicit written permission.</p>

                <div class="row">
                    <div class="col-12 col-md-6">
                        {{-- Organizations by Type --}}
                        @include('discover.insights.widgets.organizations-by-type')
                    </div>
                    <div class="col-12 col-md-6">
                        {{-- Organization Focus Chart --}}
                        @include('discover.insights.widgets.companies-by-focus-drug')
                    </div>
                </div>
            </div>
        </div>

        @include('footers.full')

    </main>
@endsection
