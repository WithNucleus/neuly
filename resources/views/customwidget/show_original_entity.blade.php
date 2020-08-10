<div class="{{ $widget['class'] ?? 'well mb-2' }} mt-4">

    <div class="row">

        <div class="col-12 col-md-8 col-xl-8 d-flex">
            <div class="card card-body flex-fill">
                @if($widget['isUpdate'] == 0)
                    This request is a for a new entry. Therefore there is no data for an entity that should be updated.
                @else
                    <h3>Original Record</h3>
                    @include('customwidget.show_original_'.strtolower($entry['type']))
                @endif
            </div>
        </div>
    </div>
</div>
