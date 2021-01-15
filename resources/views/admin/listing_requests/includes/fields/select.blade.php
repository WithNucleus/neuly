<?php
$currentValue = null;

if (isset($entity->{$field})) {
    $currentValue = $entity->{$field};
}
?>
<select name="{{ $field }}" class="form-control" {{ $isOriginalEntity ? 'disabled' : '' }}>
    @foreach($options['values'] as $key => $value)
        <option value="{{ $key }}" {{ $key == $currentValue ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>

