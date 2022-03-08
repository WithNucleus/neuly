<div class="widget-controls mb-3">
    <div class="d-flex align-items-stretch">
        <button class="btn btn-sm has-accordion-arrow" type="button" data-toggle="collapse" data-target="#combined-feed-type" aria-expanded="false" aria-controls="media-type">
            Category Filter
        </button>
        <x-enterprise.widgets.controls.page-size widgetName="combined-feed" default="10" />
    </div>
    <x-enterprise.widgets.controls.checkboxes id="combined-feed-type" filter="type" url="{{ route('enterprise.dashboard.filters') }}?search=media_items&for=media_type"/>
</div>
