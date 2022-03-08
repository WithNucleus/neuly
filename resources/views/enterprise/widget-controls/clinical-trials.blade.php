<div class="widget-controls mb-3">
    <div class="d-flex align-items-stretch">
        <button class="btn btn-sm has-accordion-arrow" type="button" data-toggle="collapse" data-target="#clinical-trial-focus" aria-expanded="false" aria-controls="clinical-trial-focus">
            Focus Filter
        </button>
        <x-enterprise.widgets.controls.page-size widgetName="clinical-trials" />
    </div>
    <x-enterprise.widgets.controls.checkboxes id="clinical-trial-focus" url="{{ route('enterprise.dashboard.filters') }}?search=focus&for=clinicaltrials"/>
</div>
