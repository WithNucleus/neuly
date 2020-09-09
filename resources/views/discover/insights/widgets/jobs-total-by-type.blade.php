<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center">Jobs by Type</h3>
        <div class="mx-auto" style="max-width: 320px;">
            <canvas class="js-chart-pie-with-action" width="300" height="300" data-action="{{ route('insights.jobs-by-type') }}"></canvas>
        </div>
        <p class="mb-0 text-center"><a href="{{ route('discover.jobs') }}" class="btn btn-sm btn-dark">Explore Jobs</a></p>
    </div>
</div>
