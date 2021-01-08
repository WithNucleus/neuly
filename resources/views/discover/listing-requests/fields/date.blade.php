<input class="form-control datepicker" type="text" name="{{ $field }}"
       value="{{ ($entity && $entity->{$field}) ? $entity->{$field}->format(config('app.date_format')) : null }}"/>
