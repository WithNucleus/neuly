@guest
    <div class="container py-5">
        <div class="row">
            <div class="mx-auto col-12 col-md-8 col-lg-7">
                <p class="lead text-white text-center">
                    Join today to get access to our extensive psychedelic database + your Neuly dashboard to follow &amp; save info, take notes, and more.
                </p>
            </div>
        </div>
        <p class="text-center mb-0">
            <a href="{{ route('register') }}" class="btn btn-primary font-weight-bold btn-lg text-uppercase">Register</a>
        </p>
    </div>
@else
    <div class="container py-5">
        <div class="row">
            <div class="mx-auto col-12 col-md-10 col-lg-8">
                <p class="lead text-white text-center">
                    Welcome back, {{ Auth::user()->name }}, and thank you for being a member of Neuly! Let us know if you have any suggestions for new features or improving our website and tools.
                </p>
            </div>
        </div>
        <p class="text-center mb-0">
            <a href="{{ route('feedback.create') }}" class="btn btn-primary font-weight-bold btn-lg text-uppercase">Contact Us</a>
        </p>
    </div>
@endguest
