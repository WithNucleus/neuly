<li class="list-group-item px-0">
    @isset($item['description'])
        <button
            class="btn btn-toggle btn-toggle-tall border-0"
            data-bs-toggle="collapse" data-bs-target="#primary-outcome-{{ $uniqueId }}" aria-expanded="false">
            <span>{{ $item['measure'] }}</span>
            @isset($item['timeFrame'])
                <span class="d-block small text-muted fw-normal">{{ $item['timeFrame'] }}</span>
            @endisset

        </button>
        <div class="collapse" id="primary-outcome-{{ $uniqueId }}">
            <p class="px-4 mb-0 small text-secondary">{{ $item['description'] }}</p>
        </div>
    @else
        <div>
            <span>{{ $item['measure'] }}</span>
            @isset($item['timeFrame'])
                <span class="d-block small text-muted fw-normal">{{ $item['timeFrame'] }}</span>
            @endisset
        </div>
    @endisset
</li>
