<div class="map-type-filters">
    <?php if (isset($filters_type) && $filters_type) : ?>
        @foreach($all_filters_type as $type)
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="type" id="type{{$type}}" value="{{ $type }}" @if(in_array($type, $filters_type)) checked @endif>
                <label class="custom-control-label font-size-large" for="type{{ $type }}">{{ ucwords($type) }}</label>
            </div>
        @endforeach
    <?php else : ?>
        @foreach($all_filters_type as $type)
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="type" id="type{{$type}}" value="{{ $type }}" checked>
                <label class="custom-control-label font-size-large" for="type{{ $type }}">{{ ucwords($type) }}</label>
            </div>
        @endforeach
    <?php endif; ?>

    <button onClick="clearFilters()" class="btn btn-link pl-0 mt-4 text-dark">
        <i class="fad fa-layer-group mr-2"></i>Show All Data
    </button>
</div>

@include('sidebars.filters.scripts')
