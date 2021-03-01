<input class="form-control" type="number" name="{{ $field }}"
       value="{{ isset($entity->{$field}) ? $entity->{$field} : null }}" {{ $isOriginalEntity ? 'disabled' : '' }}/>
