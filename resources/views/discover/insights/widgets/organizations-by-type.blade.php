<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center">Organizations by Type</h3>
        <div class="mx-auto" style="max-width: 320px;">
            <canvas class="js-chart-pie-with-action" width="300" height="300" data-action="{{ route('insights.companies-by-type') }}"></canvas>
        </div>
        <p class="mb-0 text-center"><a href="{{ route('discover.organizations') }}" class="btn btn-sm btn-dark">Explore Organizations</a></p>
    </div>
</div>
