@if ($crud->hasAccess('locationsGeocoding') && $crud->totalLocationsForGeocoding > 0)
    @if ($crud->geocodingCanBeStarted)
        <a href="{{ route('admin.location-geocoding.run') }} " class="btn btn-info">
            <i class="la la-map-marker"></i> Run geocoding ({{ $crud->totalLocationsForGeocoding }})
        </a>
    @else
        <span class="text-muted">Geocoding job finished less then 24h ago. Please try later.</span>
    @endif
@endif
