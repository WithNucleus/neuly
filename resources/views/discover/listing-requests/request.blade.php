@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')
    @include('navbars.primary')
    <div class="container-fluid">

        <div class="row">

            <main id="content-main" role="main" class="col-lg-8 mx-auto">
                <div class="row">

                    <div class="col-12">
                        @include('discover.includes.status-messages')

                        <div class="card shadow-sm mt-3">
                            <div class="card-body">
                                <h1 class="text-center text-primary page-title-default">Are we missing something?</h1>
                                <p class="lead-smaller text-center">
                                    Neuly is the most in depth database for the psychedelics industry, but we’re always looking for ways to improve.
                                </p>
                                <p class="font-size-large text-center">
                                    Please fill out the following form if you’d like to add or edit an organization, people, event, job, or other data set.
                                </p>
                                <div class="col-lg-6 mx-auto mt-4 border-top pt-4">
                                        <form method="post" action="{{ route('listing.request') }}">
                                            @csrf

                                            <div class="form-group">
                                                <label class="d-block font-weight-bold">Are you requesting to add or update a resource?</label>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input class="custom-control-input js-listing-request-is-update-input" type="radio" name="is_update" id="new_entry" value="0" checked>
                                                    <label class="custom-control-label" for="new_entry">
                                                        Add New
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input class="custom-control-input js-listing-request-is-update-input" type="radio" name="is_update" id="update_entry" value="1">
                                                    <label class="custom-control-label" for="update_entry">
                                                        Update Existing
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Type of listing</label>
                                                <select class="custom-select js-listing-request-entity-type" name="entity_type"
                                                        data-action="{{ route('listing.request.getEntityListJson') }}">
                                                    @foreach($entityTypes as $alias => $entityClass)
                                                        <option value="{{ $alias }}">{{ ucfirst($alias) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group typeahead-wrapper js-listing-request-update-entity-block" style="display: none">
                                                <label class="font-weight-bold">What entity do you want to update?</label>
                                                <div class="form-group mb-4 pb-4">
                                                    <input type="text" class="form-control js-listing-request-update-entity-input" placeholder="Entity name">
                                                    <input type="hidden" class="js-listing-request-to-update-input" name="to_update_id" value="">
                                                </div>
                                            </div>

                                            <div class="form-group text-right">
                                                <button class="btn btn-primary ml-auto mr-0" type="submit">next</button>
                                            </div>
                                        </form>

                                        <p class="font-size-small">*Note that Neuly adds new data at the company’s sole discretion.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('footers.mini')

            </main>

        </div>

    </div>
@endsection

@section('after_scripts')
<style>
    .typeahead-wrapper .twitter-typeahead {
        width: 100%;
    }
</style>
<script>
    $(document).ready(function () {
        let isUpdate = 0,
            isUpdateInput = $('.js-listing-request-is-update-input'),
            entityTypeSelect = $('.js-listing-request-entity-type'),
            getListActionUrl = entityTypeSelect.data('action'),
            entityUpdateBlock = $('.js-listing-request-update-entity-block'),
            entityUpdateInput = $('.js-listing-request-update-entity-input'),
            toUpdateIdInput = $('.js-listing-request-to-update-input'),
            entityIdsByName = [],
            entityNames = [];

        isUpdateInput.on('change', function () {
            isUpdate = parseInt($(this).val());

            refreshUpdateEntitiesList();
        });

        entityTypeSelect.on('change', function () {
            refreshUpdateEntitiesList();
        });

        function refreshUpdateEntitiesList() {
            entityUpdateBlock.hide();
            entityUpdateInput.val('').typeahead('destroy');
            toUpdateIdInput.val('');
            entityIdsByName = [];
            entityNames = [];

            if (isUpdate === 0) {
                return false;
            }

            let entityType = entityTypeSelect.val();

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

                    entityUpdateInput.typeahead(null, {
                        name: 'entitiesList',
                        source: entitiesList
                    });

                    entityUpdateBlock.show();
                }
            });
        }

        entityUpdateInput.bind('typeahead:select', function (event, item) {
            let toUpdateId = entityIdsByName[item];

            toUpdateIdInput.val(toUpdateId);
        });
    });
</script>
@endsection
