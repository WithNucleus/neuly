<?php
$titleField = in_array($field, ['name', 'job_title']);
?>
<input class="form-control {{ $titleField ? 'js-has-slug' : '' }}" type="text" name="{{ $field }}"
       value="{{ isset($entity->{$field}) ? $entity->{$field} : null }}"
    {{ $titleField ? 'required' : '' }} {{ $isOriginalEntity ? 'disabled' : '' }}/>
