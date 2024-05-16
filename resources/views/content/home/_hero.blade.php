<div class="home-hero">
    <div class="container text-center">
        <h1 class="text-accent">Participate in Psychedelic Clinical Trials</h1>
        @auth
            <p class="fs-4 my-4">Welcome back, {{ Auth::user()->name }}!</p>
            <div class="text-center mb-5">
                <a href="{{ Auth::user()->dashboard_link }}" class="btn btn-primary btn-lg btn-cta">Go to Your Dashboard</a>
            </div>
        @else
            <p class="fs-6 my-4">You'll also gain access to the psychedelic industry’s most robust platform for free.</p>
            <div class="my-4 d-flex flex-column justify-content-center" style="min-height: 100px">
                <div class="email-optin mx-auto d-flex flex-column justify-content-center h-100">
                    <livewire:public.opt-ins.email-signup />
                </div>
                <div class="login-widget h-100 mx-auto">
                    <livewire:public.auth.login />
                </div>
            </div>
            <p class="fs-6 my-4">Join over 4,000 community members</p>
        @endif
        <div class="d-flex flex-wrap justify-content-center">
            @foreach($investors as $investor)
                <div class="my-3 mx-4 px-xl-2">
                    <img src="{{ asset('/images/home/' . $investor['image']) }}" alt="{{ $investor['name'] }}" class="img-height-80 rounded-circle" />
                    <div class="fs-6 mt-1">{{ $investor['name'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>
