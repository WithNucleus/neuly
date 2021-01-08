<br>
@if($entity->{$field})
    @if($entity->entityImageUrl)
        <img src="{{ $entity->entityImageUrl }}" style="max-width: 300px;" />
    @endif
@else
    <p><span class="badge badge-secondary">No image</span></p>
@endif
<br>
<input type="file" name="{{$field}}">
