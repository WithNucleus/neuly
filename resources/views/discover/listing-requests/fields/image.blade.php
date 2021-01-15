<br>
@isset($entity)
    @if($entity->entityImageUrl)
        <img src="{{ $entity->entityImageUrl }}" style="max-width: 300px;" />
        <br>
    @else
        <p><span class="badge badge-secondary">No image</span></p>
    @endif
@endisset
<input type="file" name="{{$field}}">
