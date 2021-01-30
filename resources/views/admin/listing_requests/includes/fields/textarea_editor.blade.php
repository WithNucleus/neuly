<textarea class="form-control ckeditor-min" name="{{ $field }}"
    {{ $isOriginalEntity ? 'disabled' : '' }}>{!! isset($entity->{$field}) ? $entity->{$field} : null !!}</textarea>
