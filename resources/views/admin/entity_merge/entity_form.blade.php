<?php
/**
 * @var array $mapping
 * @var \Illuminate\Database\Eloquent\Model $masterEntity
 * @var \Illuminate\Database\Eloquent\Model $secondaryEntity
 */

use App\Helpers\EntityMergeHelper;
?>
<input type="hidden" name="master_id" value="{{ $masterEntity->id }}"/>
<input type="hidden" name="secondary_id" value="{{ $secondaryEntity->id }}"/>

@foreach($mapping as $name => $options)
    @php
        $fieldGroup = $options['type'] === EntityMergeHelper::TYPE_RELATION ? 'relations' : 'attributes';
    @endphp
    <div class="row">
        <div class="col-5">
            <div class="form-group">
                <label>{{ isset($options['label']) ? $options['label'] : EntityMergeHelper::makeLabelFromFieldName($name) }}</label>
                @include(EntityMergeHelper::getFieldViewPathByType($options['type']), ['entity' => $masterEntity])
            </div>
        </div>

        <div class="col-2 d-flex align-items-center justify-content-center merge-buttons-column">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary active">
                    <input type="radio" name="{{ $fieldGroup . '[' . $name . ']' }}" value="{{ EntityMergeHelper::SOURCE_MASTER }}" checked/> Master
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="{{ $fieldGroup . '[' . $name . ']' }}" value="{{ EntityMergeHelper::SOURCE_SECONDARY }}"/> Secondary
                </label>
            </div>
        </div>

        <div class="col-5">
            <div class="form-group">
                <label>{{ isset($options['label']) ? $options['label'] : EntityMergeHelper::makeLabelFromFieldName($name) }}</label>
                @include(EntityMergeHelper::getFieldViewPathByType($options['type']), ['entity' => $secondaryEntity])
            </div>
        </div>
    </div>
    <hr>
@endforeach
