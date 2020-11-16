<?php
$idName = $field['name'] . '_id';
$typeName = $field['name'] . '_type';
?>
@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>

    <div class="row">
        <div class="col-sm-12">
            @foreach($field['data'] as $key => $data)
                <div class="form-check form-check-inline">
                    <input id="{{ $typeName . $loop->index }}" class="form-check-input js-{{ $field['name'] }}-radio" type="radio"
                           name="{{ $typeName }}" value="{{ $data['type'] }}" data-target=".js-{{ $field['name'] }}-{{ $key }}"
                        {{ (isset($field['value']) && get_class($field['value']) == $data['type']) ? 'checked' : '' }}>
                    <label for="{{ $typeName . $loop->index }}" class="radio-inline form-check-label font-weight-normal">{{ $data['label'] }}</label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            @foreach($field['data'] as $key => $data)
                <div class="js-{{ $field['name'] }}-common js-{{ $field['name'] }}-{{ $key }}"
                     {!! (isset($field['value']) && get_class($field['value']) == $data['type']) ? '' : 'style="display: none"' !!}>

                    <select name="{{ $idName }}" class="form-control" data-init-function="bpFieldInitSelect2Morph1nElement"
                        {!! (isset($field['value']) && get_class($field['value']) == $data['type']) ? '' : 'disabled' !!}>
                        @foreach($data['options'] as $id => $value)
                            <option value="{{ $id }}"
                                {{ (isset($field['value'])
                                    && get_class($field['value']) == $data['type']
                                    && $field['value']->id == $id) ? 'selected' : '' }}>
                                {{ $value }}</option>
                        @endforeach
                    </select>

                </div>
            @endforeach
        </div>
    </div>
@include('crud::fields.inc.wrapper_end')

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->fieldTypeNotLoaded($field))
    @php
        $crud->markFieldTypeAsLoaded($field);
    @endphp

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
        <!-- include select2 css-->
        <link href="{{ asset('packages/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <!-- include select2 js-->
        <script src="{{ asset('packages/select2/dist/js/select2.full.min.js') }}"></script>
        @if (app()->getLocale() !== 'en')
            <script src="{{ asset('packages/select2/dist/js/i18n/' . app()->getLocale() . '.js') }}"></script>
        @endif
        <script>
            $('.js-{{ $field['name']}}-radio').on('change', function () {
                let target = $($(this).data('target')),
                    allSelects = $('.js-{{ $field['name'] }}-common');

                allSelects.hide();
                allSelects.find('select').attr('disabled', true);

                target.show();
                target.find('select').attr('disabled', false);
            });

            function bpFieldInitSelect2Morph1nElement(element) {
                if (!element.hasClass("select2-hidden-accessible"))
                {
                    element.select2({
                        theme: "bootstrap"
                    }).on('select2:unselect', function(e) {
                        if ($(this).attr('multiple') && $(this).val().length == 0) {
                            $(this).val(null).trigger('change');
                        }
                    });
                }
            }
        </script>
    @endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
