<div class="widget-controls mb-3">
    <div class="d-flex align-items-stretch">
        <button class="btn btn-sm has-accordion-arrow filter-control" type="button" data-toggle="collapse"
                data-target="#filters-leading-companies-clinical-trials" aria-expanded="false"
                aria-controls="filters-leading-companies-clinical-trials">
            Focus Filter
        </button>

        <div class="filter-checkboxes" data-filter="focus">
            <div class="filter-group border shadow-sm px-3 py-2 collapse"
                 id="filters-leading-companies-clinical-trials">
                @foreach ($filterFocus as $value => $label)
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input"
                               id="filters-leading-companies-clinical-trials-{{ $value }}" data-name="{{ $value }}"
                            {{ $filteredFocus && in_array($value, $filteredFocus) ? 'checked' : '' }}>
                        <label class="custom-control-label"
                               for="filters-leading-companies-clinical-trials-{{ $value }}">{{ $label }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <x-enterprise.widgets.controls.page-size widgetName="leading-companies-clinical-trials" default="{{ $pageSize }}"/>
    </div>
</div>

<ul class="list-group list-group-flush mb-4 border">
    @foreach($companies as $company)
        <li class="list-group-item">
            <p class="font-weight-bold mb-1">
                <span class="text-lg-left mr-2">{{ $company->clinicaltrials_count }}</span>
                <a href="{{ route('discover.organizations.show', $company->slug) }}">{{ $company->name }}</a>
            </p>
        </li>
    @endforeach
</ul>
