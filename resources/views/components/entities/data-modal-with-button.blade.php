<div>
    <button type="button" class="btn btn-primary text-nowrap" data-bs-toggle="modal" data-bs-target="#data-modal-{{ $uniqueId }}">
        {{ $buttonLabel }}
    </button>

    <div class="modal fade" id="data-modal-{{ $uniqueId }}" tabindex="-1" aria-labelledby="data-modal-{{ $uniqueId }}-label"
         aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="data-modal-{{ $uniqueId }}-label">{{ $model->name }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <pre class="scrollable-fullscreen-code">{{ print_r($model->{$field}, true) }}</pre>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
