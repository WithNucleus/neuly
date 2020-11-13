<br>
@if($entity->{$name})
    @if($entity->entityImageUrl)
        <img src="{{ $entity->entityImageUrl }}" style="max-width: 300px;" />
    @else
        <div class="alert alert-danger">Error with image url configuration</div>
    @endif
@else
    <p><span class="badge badge-secondary">No image</span></p>
@endif
