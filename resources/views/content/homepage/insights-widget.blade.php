@guest
    <div class="card card-body shadow-sm text-center bg-white p-5 mb-4">
        <h3 class="h1 text-primary">Neuly Insights</h3>
        <p class="lead mb-4">Register for your free account to get access to all Neuly Insights.</p>
        <p class="mb-1">
            <a href="{{ route('register') }}" class="btn btn-lg btn-dark">Join Neuly</a>
        </p>
    </div>
@else
    <div class="card card-body shadow-sm text-center bg-white p-5 mb-4">
        <h3 class="h1 text-primary">Neuly Insights</h3>
        <p class="lead mb-4">View the latest insights from our psychedelics database.</p>
        <p class="mb-1">
            <a href="{{ route('discover.insights') }}" class="btn btn-lg btn-dark">View Insights</a>
        </p>
    </div>
@endguest
