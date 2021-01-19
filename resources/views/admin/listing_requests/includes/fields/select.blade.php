<?php
$currentValue = null;

if (isset($entity->{$field})) {
    $currentValue = $entity->{$field};
}
?>
<select name="{{ $field }}" class="form-control" {{ $isOriginalEntity ? 'disabled' : '' }}>
    @foreach($options['values'] as $value)
        <option value="{{ $value }}" {{ $value == $currentValue ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>

