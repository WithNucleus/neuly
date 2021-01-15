<input class="form-control" type="text" name="{{ $field }}"
       value="{{ isset($entity->{$field}) ? $entity->{$field} : null }}" {{ $isOriginalEntity ? 'disabled' : '' }}/>
