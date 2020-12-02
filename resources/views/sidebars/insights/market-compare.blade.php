<div class="organizations-locations mb-4">
    <label for="locations" class="h4">Locations</label>
    <div class="d-flex">
        <input type="text" class="typeahead form-control" name="locations-search" placeholder="e.g. New York">
        <button class="btn btn-link px-1 text-primary"><i class="fad fa-search fa-lg"></i></button>
    </div>

    <div id="locations-filter">
        <span class="d-block title"></span>

        @isset($filters_location)
            @foreach ($filters_location as $location)
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="locations" id="{{ $location }}" value="{{ $location }}" checked>
                    <label class="custom-control-label" for="{{ $location }}">{{ $location }}</label>
                </div>
            @endforeach
        @endisset
    </div>
</div>

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Focus',
    'name'      => 'focus',
    'items'     => $focuses,
    'item_filters' => $filters_focus
])

@include('sidebars.filters.checkboxes-new', [
    'label'     => 'Type',
    'name'      => 'type',
    'items'     => ['Privately Held', 'Public Company', 'Non-Profit', 'Educational Institution', 'Government Agency'],
    'item_filters' => $filters_type
])

<div class="organizations-valuation mb-4">
    <label class="h4">Valuation</label>
    @if($valuation_min && $valuation_max)
    <div id="slider"></div>
    <input type="hidden" name="valuation_min" />
    <input type="hidden" name="valuation_max" />

    <script>
        var slider = document.getElementById('slider');

        noUiSlider.create(slider, {
            start: [{{ $filters_valuation_min }}, {{ $filters_valuation_max }}],
            connect: true,
            tooltips: [true, true],
            range: {
                'min': {{ $valuation_min }},
                'max': {{ $valuation_max }}
            }
        });
    </script>

    <button class="btn btn-sm btn-primary set-valuation-filter">Set valuation filter</button>
    @else
        <div>There was not enough data to provide this filter.</div>
    @endif
</div>

@include('sidebars.filters.scripts')
