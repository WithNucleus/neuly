<div class="home-hero">
    <div class="container text-center">
        <h1 class="text-accent">Your guide to psychedelics.</h1>
        @auth
            <p class="fs-4 my-4">Welcome back, {{ Auth::user()->name }}!</p>
            <div class="text-center mb-5">
                <a href="{{ Auth::user()->dashboard_link }}" class="btn btn-primary btn-lg btn-cta">Go to Your Dashboard</a>
            </div>
        @else
            <p class="fs-6 my-4">Gain access to the psychedelic industry’s most robust platform for free.</p>
            <div class="email-optin mx-auto my-4 py-3">
                <livewire:public.opt-ins.email-opt-in form="{{ \App\Models\OptIn::FORM_HOMEPAGE_HERO }}" redirect="{{ route('register') }}" />
            </div>
            <p class="fs-6 my-4">Join over 3,000 community members</p>
        @endif
        <div class="d-flex flex-wrap justify-content-center">
            @foreach($investors as $investor)
                <div class="my-3 mx-4">
                    <img src="{{ asset('/images/home/' . $investor['image']) }}" alt="{{ $investor['name'] }}" class="img-height-80 rounded-circle" />
                    <div class="fs-6 mt-1">{{ $investor['name'] }}</div>
                    <div>{{ $investor['title'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>
