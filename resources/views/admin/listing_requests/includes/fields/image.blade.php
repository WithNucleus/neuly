@if($isOriginalEntity)
    @if($entity->entityImageUrl)
        <p><img src="{{ $entity->entityImageUrl }}" style="max-width: 300px;" /></p>
    @else
        <p><span class="badge badge-secondary">No image</span></p>
    @endif
@else
    @isset($entity->{$field})
        <p><img src="{{ Storage::url($entity->{$field})}}" style="max-width: 300px;" /></p>
    @else
        <p><span class="badge badge-secondary">No image</span></p>
    @endisset

    <div class="option-list mt-2">
        @isset($entity->{$field})
            <div class="option-item">
                <input id="entity_image_shown" type="radio" name="image_action" value="shown" checked />
                <label for="entity_image_shown"> use shown image</label>
                <input type="hidden" name="{{ $field }}" value="{{ $entity->{$field} }}"/>
            </div>
        @endif

        <div class="option-item">
            <input id="entity_image_new" type="radio" name="image_action" value="uploaded" />
            <label for="entity_image_new"> upload new image</label>
            <div class="mb-2 ml-3">
                <input type="file" name="entity_image_uploaded" />
            </div>
        </div>

        <div class="option-item">
            <input id="entity_image_none" type="radio" name="image_action" value="none" @empty($entity->{$field}) checked @endempty>
            <label for="entity_image_none"> use no image</label>
        </div>
    </div>
@endif
