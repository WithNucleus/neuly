<div class="widget-controls mb-3">
    <div class="d-flex align-items-stretch">
        <button class="btn btn-sm has-accordion-arrow" type="button" data-toggle="collapse" data-target="#patent-focus" aria-expanded="false" aria-controls="patent-focus">
            Focus Filter
        </button>
        <x-enterprise.widgets.controls.page-size widgetName="patents" />
    </div>
    <x-enterprise.widgets.controls.checkboxes id="patent-focus" url="{{ route('enterprise.dashboard.filters') }}?search=focus&for=patents"/>
</div>
