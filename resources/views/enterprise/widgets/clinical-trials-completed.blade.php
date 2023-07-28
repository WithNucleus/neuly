<div class="widget-controls mb-3">
    <div class="d-flex align-items-stretch">
            <button class="btn btn-sm has-accordion-arrow filter-control" type="button" data-toggle="collapse"
                    data-target="#filters-clinical-trials-completed-focus" aria-expanded="false"
                    aria-controls="filters-clinical-trials-completed-focus">
                Focus Filter
            </button>

            <div class="filter-checkboxes" data-filter="focus">
                <div class="filter-group border shadow-sm px-3 py-2 collapse"
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

<p class="lead text-body">Total: {{ $totalCompleted }}</p>
<ul class="list-group list-group-flush mb-4 border">
    @foreach($clinicalTrials as $clinicalTrial)
        <li class="list-group-item">
            <p class="font-weight-bold mb-1">
                <a href="{{ route('discover.clinicaltrials.show', $clinicalTrial->slug) }}">{{ $clinicalTrial->title }}</a>
            </p>

            <div class="widget-expandable-details">
                @if($clinicalTrial->focus->count() > 0)
                    <p class="text-secondarydark mb-1">
                        <i class="fad fa-flask"></i>
                        @foreach ($clinicalTrial->focus as $item)
                            {{ $item->name }}@if (!$loop->last) / @endif
                        @endforeach
                    </p>
                @endif
                @if($clinicalTrial->companies->count() > 0)
                    <p class="text-info mb-1">
                        <i class="fad fa-building"></i>
                        @foreach ($clinicalTrial->companies as $item)
                            <a href="{{ route('discover.organizations.show', $item->slug) }}" class="text-info">{{ $item->name }}</a>
                            @if (!$loop->last) / @endif
                        @endforeach
                    </p>
                @endif
                @if ($clinicalTrial->completion_date)
                    <p class="mb-2">
                        <i class="fad fa-calendar-day text-quaternary mr-1"></i>
                        <span class="mr-3">
                            <strong>Completion Date:</strong> {{ \Carbon\Carbon::parse($clinicalTrial->completion_date)->format('j F Y') }}
                        </span>
                    </p>
                @endif
            </div>
        </li>
    @endforeach
</ul>
