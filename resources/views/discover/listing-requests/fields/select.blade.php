<?php
/**
 * @var string $field
 * @var array $options
 */
$currentValue = null;

if (isset($entity)) {
    $currentValue = $entity->{$field};
}
?>
<select name="{{ $field }}" class="form-control">
    @foreach($options['values'] as $value)
        <option value="{{ $value }}" {{ $value == $currentValue ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>

