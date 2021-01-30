@if(isset($options['prefix']))
    <div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">{!! $options['prefix'] !!}</span></div>
@endif
        <input class="form-control {{ in_array($field, ['name', 'job_title']) ? 'js-has-slug' : null }}"
               type="text" name="{{ $field }}"
               value="{{ isset($entity->{$field}) ? $entity->{$field} : null }}"
               placeholder="{{ isset($options['placeholder']) ? $options['placeholder'] : null }}"
            {{ isset($options['required']) && $options['required'] ? 'required' : '' }}
            {{ $isOriginalEntity ? 'disabled' : null }}/>
@if(isset($options['prefix']))
    </div>
@endif
