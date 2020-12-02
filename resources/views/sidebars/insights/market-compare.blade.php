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
    <!--<div class="min-max-slider" data-legendnum="2">
        <label for="min">Minimum Valuation</label>
        <input id="min" class="min" name="valuation_min" value="10188911" type="range" step="1" min="{{ $valuation_min }}" max="{{ $valuation_max }}" />
        <label for="max">Maximum Valuation</label>
        <input id="max" class="max" name="valuation_max" value="44999990.5" type="range" step="1" min="{{ $valuation_min }}" max="{{ $valuation_max }}" />
    </div>-->
    <button class="btn btn-sm btn-primary set-valuation-filter">Set valuation filter</button>
    <!--<script>
        var thumbsize = 14;

        function draw(slider,splitvalue) {

            /* set function vars */
            var min = slider.querySelector('.min');
            var max = slider.querySelector('.max');
            var lower = slider.querySelector('.lower');
            var upper = slider.querySelector('.upper');
            var legend = slider.querySelector('.legend');
            var thumbsize = parseInt(slider.getAttribute('data-thumbsize'));
            var rangewidth = parseInt(slider.getAttribute('data-rangewidth'));
            var rangemin = parseInt(slider.getAttribute('data-rangemin'));
            var rangemax = parseInt(slider.getAttribute('data-rangemax'));

            /* set min and max attributes */
            min.setAttribute('max',splitvalue);
            max.setAttribute('min',splitvalue);

            /* set css */
            min.style.width = parseInt(thumbsize + ((splitvalue - rangemin)/(rangemax - rangemin))*(rangewidth - (2*thumbsize)))+'px';
            max.style.width = parseInt(thumbsize + ((rangemax - splitvalue)/(rangemax - rangemin))*(rangewidth - (2*thumbsize)))+'px';
            min.style.left = '0px';
            max.style.left = parseInt(min.style.width)+'px';
            min.style.top = lower.offsetHeight+'px';
            max.style.top = lower.offsetHeight+'px';
            legend.style.marginTop = min.offsetHeight+'px';
            slider.style.height = (lower.offsetHeight + min.offsetHeight + legend.offsetHeight)+'px';

            /* correct for 1 off at the end */
            if(max.value>(rangemax - 1)) max.setAttribute('data-value',rangemax);

            /* write value and labels */
            max.value = max.getAttribute('data-value');
            min.value = min.getAttribute('data-value');
            lower.innerHTML = min.getAttribute('data-value');
            upper.innerHTML = max.getAttribute('data-value');

        }

        function init(slider) {
            /* set function vars */
            var min = slider.querySelector('.min');
            var max = slider.querySelector('.max');
            var rangemin = parseInt(min.getAttribute('min'));
            var rangemax = parseInt(max.getAttribute('max'));
            var avgvalue = (rangemin + rangemax)/2;
            var legendnum = slider.getAttribute('data-legendnum');

            /* set data-values */
            min.setAttribute('data-value',rangemin);
            max.setAttribute('data-value',rangemax);

            /* set data vars */
            slider.setAttribute('data-rangemin',rangemin);
            slider.setAttribute('data-rangemax',rangemax);
            slider.setAttribute('data-thumbsize',thumbsize);
            slider.setAttribute('data-rangewidth',slider.offsetWidth);

            /* write labels */
            var lower = document.createElement('span');
            var upper = document.createElement('span');
            lower.classList.add('lower','value');
            upper.classList.add('upper','value');
            lower.appendChild(document.createTextNode(rangemin));
            upper.appendChild(document.createTextNode(rangemax));
            slider.insertBefore(lower,min.previousElementSibling);
            slider.insertBefore(upper,min.previousElementSibling);

            /* write legend */
            var legend = document.createElement('div');
            legend.classList.add('legend');
            var legendvalues = [];
            for (var i = 0; i < legendnum; i++) {
                legendvalues[i] = document.createElement('div');
                var val = Math.round(rangemin+(i/(legendnum-1))*(rangemax - rangemin));
                legendvalues[i].appendChild(document.createTextNode(val));
                legend.appendChild(legendvalues[i]);

            }
            slider.appendChild(legend);

            /* draw */
            draw(slider,avgvalue);

            /* events */
            min.addEventListener("input", function() {update(min);});
            max.addEventListener("input", function() {update(max);});
        }

        function update(el){
            /* set function vars */
            var slider = el.parentElement;
            var min = slider.querySelector('#min');
            var max = slider.querySelector('#max');
            var minvalue = Math.floor(min.value);
            var maxvalue = Math.floor(max.value);

            /* set inactive values before draw */
            min.setAttribute('data-value',minvalue);
            max.setAttribute('data-value',maxvalue);

            var avgvalue = (minvalue + maxvalue)/2;

            /* draw */
            draw(slider,avgvalue);
        }

        var sliders = document.querySelectorAll('.min-max-slider');
        sliders.forEach( function(slider) {
            init(slider);
        });
    </script>
    <style>
        .min-max-slider {position: relative; width: 200px; text-align: center;}
        .min-max-slider > label {display: none;}
        span.value {height: 1.7em; font-weight: bold; display: inline-block;}
        span.value.lower::before {content: "$"; display: inline-block;}
        span.value.upper::before {content: "- $"; display: inline-block; margin-left: 0.4em;}
        .min-max-slider > .legend {display: flex; justify-content: space-between;}
        .min-max-slider > .legend > * {font-size: small; opacity: 0.25;}
        .min-max-slider > input {cursor: pointer; position: absolute;}

        /* webkit specific styling */
        .min-max-slider > input {
            -webkit-appearance: none;
            outline: none!important;
            background: transparent;
            background-image: linear-gradient(to bottom, transparent 0%, transparent 30%, silver 30%, silver 60%, transparent 60%, transparent 100%);
        }
        .min-max-slider > input::-webkit-slider-thumb {
            -webkit-appearance: none; /* Override default look */
            appearance: none;
            width: 14px; /* Set a specific slider handle width */
            height: 14px; /* Slider handle height */
            background: #eee; /* Green background */
            cursor: pointer; /* Cursor on hover */
            border: 1px solid gray;
            border-radius: 100%;
        }
        .min-max-slider > input::-webkit-slider-runnable-track {cursor: pointer;}
    </style>-->
    @else
        <div>There was not enough data to provide this filter.</div>
    @endif
</div>

@include('sidebars.filters.scripts')
