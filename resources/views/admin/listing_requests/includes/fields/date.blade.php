<?php
$value = null;

if (isset($entity->{$field})) {
    if ($entity->{$field} instanceof \Carbon\Carbon === false) {
        $entity->{$field} = \Carbon\Carbon::create($entity->{$field});
    }

    $value = $entity->{$field}->format(config('app.date_format'));
}
?>
<input class="form-control datepicker" type="text" name="{{ $field }}"
       value="{{ $value }}" {{ $isOriginalEntity ? 'disabled' : '' }}/>
