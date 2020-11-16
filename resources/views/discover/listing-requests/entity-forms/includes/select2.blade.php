<?php
/**
 * @var string $label
 * @var string $name
 * @var array $items
 * @var bool|null $required
 */
?>
@if(!empty($items))
    <div class="form-group">
        <label class="font-weight-bold">{{ $label }}:</label><br>
        <select name="{{ $name }}"  class="form-control select2" {{ isset($required) && $required ? 'required' : ''}}>
            <option value="" disabled selected>Select {{ $label }}</option>
            @foreach($items as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <style>
        .select2-container .select2-selection--single {
            min-height: 40px;
        }

        .select2-selection__rendered {
            line-height: 40px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            margin-top: 4px !important;
        }
    </style>
@endif
