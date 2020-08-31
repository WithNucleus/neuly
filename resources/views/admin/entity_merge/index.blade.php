@extends(backpack_view('layouts.top_left'))

@section('header')
    <section class="container-fluid">
        <h2>
            <span class="text-capitalize">Merge Entities</span>
        </h2>
    </section>
@endsection

@section('content')

@include('admin.includes.status-messages')

<form method="post" action="{{ route('admin.entityMerge.merge') }}">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="entity-type">Choose entity type:</label>
                <select id="entity-type" class="form-control js-entity-type-select" name="entity_type"
                        data-action-get-list="{{ route('admin.entityMerge.getEntityListJson') }}"
                        data-action-get-entity-form= {{ route('admin.entityMerge.getEntityForm') }}>
                    <option></option>
                    @foreach($entities as $entity)
                        <option value="{{$entity}}">{{ ucfirst($entity) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="card js-merge-container" style="display: none;">
        <div class="row">
            <div class="col-12">

                <div class="card-header">
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <label for="master-entity" class="h5">Master entity:</label><br>
                                <input id="master-entity" class="form-control js-master-entity-input" type="text"
                                       autocomplete="false" name="master_entity" value=""/>
                            </div>
                        </div>
                        <div class="col-5 offset-2">
                            <div class="form-group">
                                <label for="secondary-entity" class="h5">Secondary entity:</label><br>
                                <input id="secondary-entity" class="form-control js-secondary-entity-input" type="text"
                                       autocomplete="false" name="secondary_entity" value=""/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body js-merge-body">
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary js-submit-merge-btn" disabled>
                                <i class="la la-sync"></i> Merge
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</form>
@endsection

@section('after_scripts')
    <style>
        .merge-buttons-column .btn:not(:disabled):not(.disabled).active,
        .merge-buttons-column .btn:not(:disabled):not(.disabled):active {
            color: #fff;
            background-color: #2e66b5;
            border-color: #2b60ab;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-tagsinput.css') }}"/>
    <script type="text/javascript" src="{{ asset('assets/typeahead.js') }}"></script>
    <script>
        $(document).ready(function () {
            let entityTypeSelect = $('.js-entity-type-select'),
                getListAction = entityTypeSelect.data('action-get-list'),
                getEntityForm = entityTypeSelect.data('action-get-entity-form'),
                masterInput = $('.js-master-entity-input'),
                secondaryInput = $('.js-secondary-entity-input'),
                mergeContainer = $('.js-merge-container'),
                mergeBody = $('.js-merge-body'),
                submitMergeBtn = $('.js-submit-merge-btn'),
                entityIdsByName = [],
                entityNames = [],
                entityType,
                masterId,
                secondaryId;

            entityTypeSelect.on('change', function () {
                resetPage();

                entityType = $(this).val();

                if (entityType === '') {
                    return false;
                }

                $.getJSON(getListAction, {'entity_type': entityType}, function (response) {
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

                        masterInput.typeahead(null, {
                            name: 'master',
                            source: entitiesList
                        });
                        secondaryInput.typeahead(null, {
                            name: 'secondary',
                            source: entitiesList
                        });

                        mergeContainer.show();
                    }
                });
            });

            masterInput.bind('typeahead:select', function (event, item) {
                masterId = entityIdsByName[item];

                if (secondaryId !== '') {
                    getBody();
                }
            });

            secondaryInput.bind('typeahead:select', function (event, item) {
                secondaryId = entityIdsByName[item];

                if (masterId !== '') {
                    getBody();
                }
            });

            function getBody() {
                if (masterId === secondaryId) {
                    mergeBody.html('<div class="col-md-4 alert alert-danger">Can\'t merge same entities!</div>');
                    return false;
                }

                $.getJSON(getEntityForm, {
                    'entity_type': entityType,
                    'master_id': masterId,
                    'secondary_id': secondaryId
                }, function (response) {
                    if (response.status === 'ok') {
                        mergeBody.html(response.data);
                        submitMergeBtn.attr('disabled', false);
                    }
                });
            }

            function resetPage() {
                submitMergeBtn.attr('disabled', true);
                mergeContainer.hide();
                masterInput.val('').typeahead('destroy');
                secondaryInput.val('').typeahead('destroy');
                mergeBody.text('Choose 2 entities to start merging');
                entityIdsByName = [];
                entityNames = [];
                masterId = '';
                secondaryId = '';
            }

            $('.js-submit-merge-btn').on('click', function(e) {
                e.preventDefault();

                swal({
                    title: "Are you sure?",
                    text: "Your will not be able to recover secondary entity!",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: 'Cancel',
                            value: false,
                            visible: true,
                            className: "bg-secondary",
                            closeModal: true,
                        },
                        merge: {
                            text: "Merge!",
                            value: true,
                            visible: true,
                            className: "bg-primary",
                        }
                    },
                }).then((value) => {
                    if (value) {
                        $('form').submit();
                    }
                });
            });
        });
    </script>
@endsection
