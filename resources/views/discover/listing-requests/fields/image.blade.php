<br>
<p>
@isset($entity)
    @if($entity->entityImageUrl)
        <img src="{{ $entity->entityImageUrl }}" style="max-width: 300px;" />
    @else
        <span class="badge badge-secondary">No image</span>
    @endif
@endisset
</p>
<p><input type="file" name="{{$field}}"></p>
