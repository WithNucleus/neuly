<?php
$currentValues = [];

if (!empty($entity->{$field})) {
    if ($isOriginalEntity) {
        $currentValues = $entity->{$field}->pluck('id')->toArray();
    } else {
        $currentValues = $entity->{$field};
    }
}
?>
@isset($relationValues[$field])
<select name="{{ $field }}[]" class="form-control {{ count($relationValues[$field]) > 10 ? 'select2' : '' }}" multiple
    {{ $isOriginalEntity ? 'disabled' : '' }}>
    @foreach($relationValues[$field] as $key => $value)
        <option value="{{ $key }}" {{ in_array($key, $currentValues) ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>
@endisset

