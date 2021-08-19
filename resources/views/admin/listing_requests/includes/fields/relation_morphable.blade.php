<?php

use App\Helpers\EntityHelper;

/**
 * @var string $field
 * @var array $options
 * @var array $relationValues
 */

$relationMorphableTypes = [];

foreach ($options['relationMorphableTypes'] as $relationClass) {
    $type = EntityHelper::getAliasByClass($relationClass);
    $relationMorphableTypes[$type] = $relationClass;
}

$currentId = null;
$currentType = null;

if (!empty($entity->{$field})) {
    if ($isOriginalEntity) {
        $currentTypeClass = get_class($entity->{$field});
        $currentType = EntityHelper::getAliasByClass($currentTypeClass);
    } else {
        $currentId = $entity->{$field}->id;
        $currentType = $entity->{$field}->type;
    }
}

?>
@if($isOriginalEntity)
    <div class="row mb-2">
        <div class="col-sm-12">
            {{ $entity->{$field}->{$options['relationField']} }} ({{ ucfirst($currentType) }})
        </div>
    </div>
@else
    <div class="row mb-2">
        <div class="col-sm-12">
            @foreach($relationMorphableTypes as $type => $relationClass)
                <div class="form-check form-check-inline">
                    <input id="{{$field}}-{{$type}}-type" class="form-check-input js-morphable-input-type" type="radio"
                           name="{{$field}}[type]" value="{{$type}}" {{ $currentType == $type ? 'checked' : '' }}
                           data-group=".js-{{$field}}-list-group" data-target=".js-{{$field}}-{{$type}}-list-container">
                    <label for="{{$field}}-{{$type}}-type" class="form-check-label"> {{ ucfirst($type) }}</label>
                </div>
            @endforeach
        </div>
    </div>

    @foreach($relationMorphableTypes as $type => $relationClass)
        <div class="row mb-2 js-{{$field}}-list-group js-{{$field}}-{{$type}}-list-container" style="display: none;">
            <div class="col-sm-12">
                <div class="form-group">
                    <select class="form-control js-morphable-select-id" name="{{$field}}[id]"
                            {{ $currentType == $type ? '' : 'disabled' }}
                            data-fetch-action="{{ route('api.entities.list.byAlias', ['alias' => $type]) }}"
                            data-current-value="{{ $currentType == $type ? $currentId : null }}"></select>
                </div>
            </div>
        </div>
    @endforeach
@endif
