<br>
@if($entity->{$name})
    <img src="/storage/{{ $entity->{$name} }}" style="max-width: 300px;" />
@else
    <p><span class="badge badge-secondary">No image</span></p>
@endif
