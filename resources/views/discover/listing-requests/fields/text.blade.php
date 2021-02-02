@if(isset($options['prefix']))
    <div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">{!! $options['prefix'] !!}</span></div>
@endif
        <input class="form-control" type="text" name="{{ $field }}"
               value="{{ isset($entity) && !isset($options['hideOriginal']) ? $entity->{$field} : null }}"
               placeholder="{{ isset($options['placeholder']) ? $options['placeholder'] : null }}"
            {{ isset($options['required']) && $options['required'] ? 'required' : null }} />
@if(isset($options['prefix']))
    </div>
@endif
