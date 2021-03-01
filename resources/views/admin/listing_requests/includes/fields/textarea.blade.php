<textarea class="form-control" name="{{ $field }}"
    {{ $isOriginalEntity ? 'disabled' : '' }}>{!! isset($entity->{$field}) ? $entity->{$field} : null !!}</textarea>
