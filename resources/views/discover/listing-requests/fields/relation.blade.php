<?php
/**
 * @var string $field
 * @var array $relationValues
 */
$currentValues = [];

if (isset($entity)) {
    $relationData = $entity->{$field};
    $currentValues = $relationData ? $relationData->pluck('id')->toArray() : [];
}
?>
@isset($relationValues[$field])
<select name="{{ $field }}[]" class="form-control {{ count($relationValues[$field]) > 10 ? 'select2' : '' }}" multiple>
    @foreach($relationValues[$field] as $key => $value)
        <option value="{{ $key }}" {{ in_array($key, $currentValues) ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>
@endisset
