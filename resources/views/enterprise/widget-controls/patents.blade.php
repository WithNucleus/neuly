<div class="widget-controls mb-3">
    <div class="d-flex align-items-stretch">
        <x-enterprise.widgets.controls.toggle-button target="patent-focus" label="Focus Filter" />
        <x-enterprise.widgets.controls.page-size widgetName="patents" />
    </div>
    <x-enterprise.widgets.controls.checkboxes id="patent-focus" url="{{ route('enterprise.dashboard.filters') }}?search=focus&for=patents"/>
</div>
