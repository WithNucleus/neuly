<?php
$isOriginalEntity = isset($isOriginalEntity) ? $isOriginalEntity : false;
$isAlternativeView = isset($isAlternativeView) ? $isAlternativeView : false;
$currentValues = [];

if (!empty($entity->{$field})) {
    if ($isOriginalEntity || $isAlternativeView) {
        $currentValues = $entity->{$field}->pluck('id')->toArray();
    } else {
        $currentValues = $entity->{$field};
    }
}
?>
@isset($relationValues[$field])
<select name="{{ $field }}[]" class="form-control select2" multiple {{ $isOriginalEntity ? 'disabled' : '' }}>
    @foreach($relationValues[$field] as $key => $value)
        <option value="{{ $key }}" {{ in_array($key, $currentValues) ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>
@endisset

