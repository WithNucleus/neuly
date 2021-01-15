<?php
use App\Helpers\ListingRequestHelper;
use App\Helpers\Entity\FieldsMapping;
?>

@foreach($mapping as $field => $options)
    @php
        $isDifferent = ListingRequestHelper::isEntitiesFieldDifferent($originalEntity, $requestData, $field, $options);
    @endphp

<div class="row">
    <div class="col-5">
        <div class="form-group">
            <label>{{ isset($options['label']) ? $options['label'] : FieldsMapping::makeLabelFromFieldName($field) }}</label>
            @include('admin.listing_requests.includes.fields.' . ListingRequestHelper::getFieldViewByMappingOptions($options), [
                     'entity' => $originalEntity,
                     'isOriginalEntity' => true
                 ])
        </div>
    </div>

    <div class="col-2 d-flex align-items-center justify-content-center merge-buttons-column">
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-secondary active">
                <input type="radio" name="{{ 'source[' . $field . ']' }}"
                       value="{{ ListingRequestHelper::SOURCE_ORIGINAL }}" checked/> {{ ucfirst(ListingRequestHelper::SOURCE_ORIGINAL) }}
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="{{ 'source[' . $field . ']' }}"
                       value="{{ ListingRequestHelper::SOURCE_REQUEST }}"/> {{ ucfirst(ListingRequestHelper::SOURCE_REQUEST) }}
            </label>
        </div>
    </div>

    <div class="col-5">
        <div class="form-group {{ $isDifferent ? 'alert alert-success' : '' }}">
            <label>{{ isset($options['label']) ? $options['label'] : FieldsMapping::makeLabelFromFieldName($field) }}</label>
            @include('admin.listing_requests.includes.fields.' . ListingRequestHelper::getFieldViewByMappingOptions($options), [
                     'entity' => $requestData,
                     'isOriginalEntity' => false
                 ])
        </div>
    </div>
</div>
@endforeach
