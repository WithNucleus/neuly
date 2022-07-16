<div class="widget-controls mb-3">
    <div class="d-flex align-items-stretch">
            <button class="btn btn-sm has-accordion-arrow filter-control" type="button" data-toggle="collapse"
                    data-target="#filters-clinical-trials-completed-focus" aria-expanded="false"
                    aria-controls="filters-clinical-trials-completed-focus">
                Focus Filter
            </button>

            <div class="filter-checkboxes" data-filter="focus">
                <div class="filter-group bg-white border shadow-sm px-3 py-2 collapse"
                     id="filters-clinical-trials-completed-focus">
                    @foreach ($filterFocus as $value => $label)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                                   id="filters-clinical-trials-completed-focus-{{ $value }}" data-name="{{ $value }}"
                                {{ $filteredFocus && in_array($value, $filteredFocus) ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                   for="filters-clinical-trials-completed-focus-{{ $value }}">{{ $label }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <x-enterprise.widgets.controls.page-size widgetName="clinical-trials-completed" default="{{ $pageSize }}"/>
    </div>
</div>

<p class="lead">Total: {{ $totalCompleted }}</p>
<p>Last completed:</p>
<ul class="list-group list-group-flush mb-4 border">
    @foreach($clinicalTrials as $clinicalTrial)
        <li class="list-group-item">
            <p class="font-weight-bold mb-1">
                <a href="{{ route('discover.clinicaltrials.show', $clinicalTrial->slug) }}">{{ $clinicalTrial->title }}</a>
            </p>
        </li>
    @endforeach
</ul>
