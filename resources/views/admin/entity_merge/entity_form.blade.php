<?php
/**
 * @var array $mapping
 * @var \Illuminate\Database\Eloquent\Model $masterEntity
 * @var \Illuminate\Database\Eloquent\Model $secondaryEntity
 */

use App\Helpers\EntityMergeHelper;
use App\Helpers\Entity\FieldsMapping;
?>
<input type="hidden" name="master_id" value="{{ $masterEntity->id }}"/>
<input type="hidden" name="secondary_id" value="{{ $secondaryEntity->id }}"/>

@foreach($mapping as $name => $options)
    @php
        $fieldGroup = $options['type'] === FieldsMapping::TYPE_RELATION ? 'relations' : 'attributes';
    @endphp
    <div class="row">
        <div class="col-5">
            <div class="form-group">
                <label>{{ isset($options['label']) ? $options['label'] : FieldsMapping::makeLabelFromFieldName($name) }}</label>
                @include('admin.entity_merge.fields.' . EntityMergeHelper::getViewByFieldType($options['type']), ['entity' => $masterEntity])
            </div>
        </div>

        <div class="col-2 d-flex align-items-center justify-content-center merge-buttons-column">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary active">
                    <input type="radio" name="{{ $fieldGroup . '[' . $name . ']' }}" value="{{ EntityMergeHelper::SOURCE_MASTER }}" checked/> {{ ucfirst(EntityMergeHelper::SOURCE_MASTER) }}
                </label>
                @if($options['type'] === FieldsMapping::TYPE_RELATION)
                    <label class="btn btn-secondary">
                        <input type="radio" name="{{ $fieldGroup . '[' . $name . ']' }}" value="{{ EntityMergeHelper::SOURCE_MERGE }}"/> {{ ucfirst(EntityMergeHelper::SOURCE_MERGE) }}
                    </label>
                @endif
                <label class="btn btn-secondary">
                    <input type="radio" name="{{ $fieldGroup . '[' . $name . ']' }}" value="{{ EntityMergeHelper::SOURCE_SECONDARY }}"/> {{ ucfirst(EntityMergeHelper::SOURCE_SECONDARY) }}
                </label>
            </div>
        </div>

        <div class="col-5">
            <div class="form-group">
                <label>{{ isset($options['label']) ? $options['label'] : FieldsMapping::makeLabelFromFieldName($name) }}</label>
                @include('admin.entity_merge.fields.' . EntityMergeHelper::getViewByFieldType($options['type']), ['entity' => $secondaryEntity])
            </div>
        </div>
    </div>
    <hr>
@endforeach
