<?php
use App\Helpers\EntityHelper;
?>
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')


<div class="row">
    <div class="col-12 col-md-4">
        <div class="card card-body">
            <h3 class="h5">Add entity to list</h3>

            <div class="form-group">
                <label class="font-weight-bold">Entity type</label>
                <select class="form-control js-entity-type-select" name="entity_type" data-action="{{ route('admin.entityMerge.getEntityListJson') }}">
                    <option value="" selected disabled>--</option>
                    @foreach($widget['entityTypes'] as $type)
                        <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Entity</label>
                <input type="text" class="form-control js-typeahead-entity-input" placeholder="Entity name...">
                <input type="hidden" class="js-entity-id-input" name="entity_id" value="">
            </div>

            <div class="form-group">
                <button class="btn btn-success js-add-entity-btn" data-action="{{ route('admin.rankedList.addEntity', $widget['rankedList']->id) }}">
                    <span class="la la-plus" role="presentation" aria-hidden="true"></span>
                    <span>Add</span>
                </button>
            </div>

            <div class="alert alert-error js-validation-error" style="display: none;">
                You must select an entity to add to the list.
            </div>
            <div class="alert alert-error js-unique-error" style="display: none;">
                This entity already exists in the list.
            </div>

        </div>
    </div>

    <div class="col-12 col-md-4">


        <div class="card card-body">
            <h3 class="h5">Entities
                <span class="small">(drag item to change order)</span>
                <button class="btn btn-primary btn-sm float-right js-save-updated-order-btn"
                        data-action="{{ route('admin.rankedList.updateEntities', $widget['rankedList']->id) }}">Save order</button>
            </h3>
            <div class="alert alert-info js-list-updated-message" style="display: none;">
                List order has been updated! Don't forget to save after finishing sorting.
            </div>

            <ol id="sortable-entities" class="list-group js-entities-list"
                data-remove-action="{{ route('admin.rankedList.removeEntity', $widget['rankedList']->id) }}">
                @foreach($widget['entities'] as $rankedItem)
                    @php
                        $entity = $rankedItem->rankable;
                        $entityClass = get_class($entity);
                    @endphp
                    <li class="list-group-item" data-rankable-id="{{ $entity->id }}" data-rankable-type="{{ $entityClass }}">
                        <div>{{ $entity->name }}</div>
                        <div>
                            <span class="badge badge-default">{{ EntityHelper::getAliasByClass($entityClass) }}</span>
                            <button class="btn btn-sm btn-link float-right js-remove-entity-btn"><i class="la la-trash"></i> Remove</button>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</div>

<style>
    span.twitter-typeahead {
        display: block !important;
    }
    .list-group {
         margin-left: 20px;
     }
    .list-group-item {
        display: list-item;
    }
</style>
{{--<script>--}}

{{--</script>--}}
@push('after_scripts')
<link rel="stylesheet" href="{{ asset('assets/bootstrap-tagsinput.css') }}"/>
<script type="text/javascript" src="{{ asset('assets/typeahead.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/sortable.min.js') }}"></script>
<script>
    $(document).ready(function () {
        let entityTypeSelect = $('.js-entity-type-select'),
            getListActionUrl = entityTypeSelect.data('action'),
            entityIdInput = $('.js-entity-id-input'),
            typeaheadInput = $('.js-typeahead-entity-input'),
            entityIdsByName = [],
            entityNames = [];

        entityTypeSelect.on('change', function () {
            resetEntityForm();

            let entityType = entityTypeSelect.val();

            $.getJSON(getListActionUrl, {'entity_type': entityType}, function (response) {
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

                    typeaheadInput.typeahead(null, {
                        name: 'entitiesList',
                        source: entitiesList
                    });
                }
            });
        });

        typeaheadInput.bind('typeahead:select', function (event, item) {
            let toUpdateId = entityIdsByName[item];

            entityIdInput.val(toUpdateId);
        });

        let sortableList = document.getElementById('sortable-entities');
        Sortable.create(sortableList, {
            animation: 150,
            ghostClass: 'bg-secondary',
            onUpdate: function () {
                $('.js-list-updated-message').show();
            }
        });

        $('.js-add-entity-btn').on('click', function (){
            let addEntityActionUrl = $(this).data('action'),
                entityId = entityIdInput.val(),
                entityType = entityTypeSelect.val(),
                entityName = typeaheadInput.val(),
                errorValidationMessage = $('.js-validation-error'),
                errorUniqueMessage = $('.js-unique-error');

            errorValidationMessage.hide();
            errorUniqueMessage.hide();

            if (entityId && entityType) {
                $.post(addEntityActionUrl, {
                    'id': entityId,
                    'type': entityType,
                }, function (response){
                    if (response.success) {
                        addListItem(entityName, response);
                    } else {
                        errorUniqueMessage.show();
                    }

                    typeaheadInput.val('');
                    entityIdInput.val('');
                });
            } else {
                errorValidationMessage.show();
            }
        });

        $('.js-remove-entity-btn').on('click', function (){
            let removeEntityActionUrl = $('.js-entities-list').data('remove-action'),
                listItem = $(this).parent(),
                rankableId = listItem.data('rankable-id'),
                rankableType = listItem.data('rankable-type');

            if (rankableId && rankableType) {
                $.post(removeEntityActionUrl, {
                    'rankable_id': rankableId,
                    'rankable_type': rankableType,
                }, function (response){
                    listItem.remove();
                });
            }
        });

        $('.js-save-updated-order-btn').on('click', function (){
            let entities = [],
                updateEntitiesActionUrl = $(this).data('action');

            $('.js-entities-list li').each(function (index){
                let listItem = $(this),
                    rankableId = listItem.data('rankable-id'),
                    rankableType = listItem.data('rankable-type'),
                    rank = index + 1;

                entities.push({
                    'rankable_id' : rankableId,
                    'rankable_type' : rankableType,
                    'rank': rank,
                });
            });

            $.post(updateEntitiesActionUrl, {'entities' : entities}, function (response) {
                $('.js-list-updated-message').hide();
            });
        });

        function addListItem(name, entity) {
            let itemHtml = '<li class="list-group-item" data-rankable-id="' + entity.id + '" data-rankable-type="' + entity.classname + '">' +
                name + '<span class="badge badge-default">' + entity.alias + '</span>' +
                '<button class="btn btn-sm btn-link float-right js-remove-entity-btn" ><i class="la la-trash"></i> Remove</button></li>';

            $('.js-entities-list').append(itemHtml);
        }

        function resetEntityForm() {
            typeaheadInput.val('').typeahead('destroy');
            entityIdInput.val('');
            entityIdsByName = [];
            entityNames = [];
        }
    });
</script>
@endpush

@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')
