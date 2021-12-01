<?php
/**
 * @var string $field
 * @var array $options
 */
$additionalClass = count($options['values']) > 10 ? 'select2' : '';
$currentValue = null;

if (isset($entity->{$field})) {
    $currentValue = $entity->{$field};
}

?>
<select name="{{ $field }}" class="form-control {{ $additionalClass }}" {{ $isOriginalEntity ? 'disabled' : '' }}>
    @if(isset($options['required']) && $options['required'] === false)
        <option value="">-</option>
    @endif
    @foreach($options['values'] as $value)
        <option value="{{ $value }}" {{ $value == $currentValue ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>

