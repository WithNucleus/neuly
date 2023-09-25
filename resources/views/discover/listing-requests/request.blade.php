@extends('layouts.app')

@section('body-class', 'listing-requests')

@section('head')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('assets/typeahead.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap-tagsinput.css') }}"/>
@endsection

@section('content')
    @include('navbars.primary')

    <div class="container my-5">
        <h1 class="text-center text-body-emphasis">Are we missing something?</h1>
        <div class="max-width-600 mx-auto lead text-center">
            <p>Neuly is the most in-depth and comprehensive database for the psychedelics industry, and we're always looking to improve. Please let us know if there's anything we should add or update.</p>
        </div>

        <div class="max-width-780 mx-auto border p-4">
            @include('discover.includes.status-messages')
            <form method="post" action="{{ route('listing.request') }}">
                @csrf

                <div class="form-group mb-3">
                    <label class="lead d-block">Are you requesting to add or update a resource?</label>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input js-listing-request-is-update-input" type="radio" name="is_update" id="new_entry" value="0" checked>
                        <label class="form-check-label" for="new_entry">
                            Add New
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input js-listing-request-is-update-input" type="radio" name="is_update" id="update_entry" value="1">
                        <label class="form-check-label" for="update_entry">
                            Update Existing
                        </label>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Type of listing</label>
                    <select class="form-select js-listing-request-entity-type" name="entity_type" aria-label="Type of listing"
                            data-action="{{ route('listing.request.getEntityListJson') }}">
                        @foreach($entityTypes as $alias => $entityClass)
                            <option value="{{ $alias }}" class="{{ $alias == 'focus' ? 'js-disable-update' : '' }}">{{ ucfirst($alias) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group typeahead-wrapper js-listing-request-update-entity-block" style="display: none">
                    <label class="fw-bold">What entity do you want to update?</label>
                    <div class="form-group mb-4 pb-4">
                        <input type="text" class="form-control js-listing-request-update-entity-input" placeholder="Entity name">
                        <input type="hidden" class="js-listing-request-to-update-input" name="to_update_id" value="">
                    </div>
                </div>

                <div class="form-group mt-4">
                    <button class="btn btn-primary btn-lg" type="submit">Next</button>
                </div>
            </form>
        </div>

        <p class="text-center">*Note that Neuly adds new data at the company’s sole discretion.</p>

        @include('footers.full')
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
        $('select#general_type').on('change', function(event) {
            var value = $('select#general_type option:selected').text().toLowerCase();
            $('form').attr('action', '/listing/request/'+value);
        });

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
            entityTypeSelect.prop("selectedIndex", 0);
            entityTypeSelect.find('option.js-disable-update').attr('disabled', isUpdate === 1);
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
