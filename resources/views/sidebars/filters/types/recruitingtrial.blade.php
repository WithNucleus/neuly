@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Focus',
    'name'      => 'focus',
    'items'     => $focus_cats,
    'item_filters' => $filters_focus
])

@include('sidebars.filters.includes.checkboxes-new', [
    'label'     => 'Locations',
    'name'      => 'locations',
    'items'     => $locations,
    'item_filters' => $filters_location
])

@include('sidebars.filters.includes.radio-buttons', [
    'label'     => 'gender',
    'name'      => 'gender',
    'items'     => $gender,
    'item_filters' => $filters_gender
])

<div class="organizations-valuation mb-4">
<label class="h4">Age</label>
    <div class="form-group pt-5 px-5 pb-5">
        <div id="age_slider"></div>
        <input type="hidden" name="age" />
    </div>

    <script>
        var slider = document.getElementById('age_slider');

        noUiSlider.create(slider, {
            start: ['{{ $filters_age }}'],
            step: 1,
            connect: true,
            tooltips: [wNumb({
                decimals: 0,
                thousand: ',',
                postfix: ' Years',
            })],
            pips: {
                mode: 'values',
                values: [{{ $age_min }}, {{ $age_max }}],
                density: 4
            },
            range: {
                'min': {{ $age_min }},
                'max': {{ $age_max }}
            }
        });
    </script>

    <div class="form-group">
        <button class="btn btn-sm btn-primary set-age-filter">Set age filter</button>
    </div>
</div>

@include('sidebars.filters.includes.scripts')
