<?php
use App\Helpers\ListingRequestHelper;
use App\Helpers\Entity\FieldsMapping;
?>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label class="font-weight-bold">Slug</label>
            <input class="form-control" type="text" name="slug" value="" readonly/>
        </div>
    </div>
</div>
@foreach($mapping as $field => $options)
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="font-weight-bold">
                    {{ isset($options['label']) ? $options['label'] : FieldsMapping::makeLabelFromFieldName($field) }}
                </label>
                @include('admin.listing_requests.includes.fields.' . ListingRequestHelper::getFieldViewByMappingOptions($options), [
                    'entity' => $requestData,
                    'isOriginalEntity' => false
                ])
            </div>
        </div>
    </div>
@endforeach
