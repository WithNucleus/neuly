<?php
use App\Helpers\ListingRequestHelper;

/**
 * @var string $field
 * @var array $options
 * @var array $relationValues
 */

$relationMorphableTypes = [];

foreach ($options['relationMorphableTypes'] as $relationClass) {
    $alias = ListingRequestHelper::getEntityTypeByClass($relationClass);
    $relationMorphableTypes[$alias] = $relationClass;
}
?>
<div class="row mb-2">
    <div class="col-sm-12">
        @foreach($relationMorphableTypes as $alias => $relationClass)
            <div class="form-check form-check-inline">
                <input id="{{$alias}}-{{$field}}-type" class="form-check-input js-{{$field}}-type-toggle" type="radio"
                       name="{{$field}}[type]" value="{{$alias}}">
                <label for="{{$alias}}-{{$field}}-type" class="form-check-label"> {{ ucfirst($alias) }}</label>
            </div>
        @endforeach
    </div>
</div>

<div class="js-{{$field}}-list-container" style="display: none;">
    <div class="form-group">
        <input type="text" class="form-control js-{{$field}}-list-input" placeholder="Search for {{$field}} name" data-action="{{ route('listing.request.getEntityListJson') }}">
        <input type="hidden" name="{{$field}}[id]" class="js-{{$field}}-id-input" value=""/>
    </div>
</div>

<style>
    .js-{{$field}}-list-container .twitter-typeahead {
        width: 100%;
    }
</style>
<script>
    $(document).ready(function() {
        let typeToggleInput = $('.js-{{$field}}-type-toggle'),
            listContainer = $('.js-{{$field}}-list-container'),
            idInput = $('.js-{{$field}}-id-input'),
            listInput = $('.js-{{$field}}-list-input'),
            getListActionUrl = listInput.data('action'),
            entityIdsByName = [],
            entityNames = [];

        typeToggleInput.on('change', function (){
            listContainer.hide();
            listInput.val('').typeahead('destroy');
            idInput.val('');
            entityIdsByName = [];
            entityNames = [];

            let entityType = $(this).val();

            $.getJSON(getListActionUrl, {'type': entityType}, function (response) {
                if (response.status === 'ok') {
                    $.each(response.data, function (i, item) {
                        entityNames.push(item.name);
                        entityIdsByName[item.name] = item.id;
                    });

                    let entitiesList = new Bloodhound({
                        datumTokenizer: Bloodhound.tokenizers.whitespace,
                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                        local: entityNames
                    });

                    listInput.typeahead(null, {
                        name: 'entitiesList',
                        source: entitiesList
                    });

                    listContainer.show();
                }
            });
        });

        listInput.bind('typeahead:select', function (event, item) {
            idInput.val(entityIdsByName[item]);
        });
    });
</script>
