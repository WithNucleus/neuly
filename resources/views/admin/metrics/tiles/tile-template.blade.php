<div class="col-6 col-md-4 col-lg-3">
    <div class="card card-body shadow-sm">
        <h3 class="my-1">
            <a href="{{ route('admin.metrics.tiles.details') }}?entity={{ $metricEntity }}&start={{ \Carbon\Carbon::parse($filterDateStart)->format('Y-m-d') }}&end={{ \Carbon\Carbon::parse($filterDateEnd)->format('Y-m-d') }}" class="d-block">
            <span class="label d-block">
                {{ $metric['label'] }}
            </span>
            <span class="count">
                {{ $metric['count'] }}
            </span>
            </a>
        </h3>
    </div>
</div>
