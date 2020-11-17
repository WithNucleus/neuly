<?php
    $required = $general['update'] ? '' : 'required';
?>
@if ($general['update'])
    <div class="form-group mb-4 pb-4 page-title-default entity-to-update">
        <label for="entity_name" class="d-block lead text-center">What job do you want to update?</label>
        <input type="text" class="form-control updateEntity" placeholder="Search for job" data-action="{{ route('discover.jobs.titlesJson') }}" name="entity_update_resource" required>
    </div>

    <p class="lead text-center">Updated Job Details</p>
    <div class="form-group">
        <label for="entity_name" class="font-weight-bold">Job title:</label>
        <input type="text" class="form-control" name="entity_job_title" required>
    </div>
@else
    <p class="lead text-center">What job do you want to add?</p>
    <div class="form-group mb-4 pb-4 page-title-default">
        <label for="entity_name" class="sr-only">Job title:</label>
        <input type="text" class="form-control" placeholder="Job title" name="entity_job_title" required>
    </div>
@endif

{{-- Job owner section --}}
<div class="row mb-2">
    <div class="col-sm-12">
        <label class="font-weight-bold">Owner:</label><br>
        <div class="form-check form-check-inline">
            <input id="company-owner-type" class="form-check-input js-owner-type-radio" type="radio"
                   name="entity_owner_type" value="organizations" {{ $required }}>
            <label for="company-owner-type" class="form-check-label">Organization</label>
        </div>

        <div class="form-check form-check-inline">
            <input id="investor-owner-type" class="form-check-input js-owner-type-radio" type="radio"
                   name="entity_owner_type" value="investors" {{ $required }}>
            <label for="investor-owner-type" class="form-check-label">Investor</label>
        </div>
    </div>
</div>

<div class="js-owner-container" data-type="organizations" style="display: none;">
    <div class="js-existed-input-container" data-type="company">
        @include('discover.listing-requests.entity-forms.includes.select2', [
            'label' => 'Organization list',
            'name' => 'entity_company_id',
            'items' => $companies,
            'required' => $required,
        ])
    </div>

    <div class="js-new-input-container" style="display: none">
        <div class="form-group">
            <label class="font-weight-bold">New organization name:</label>
            <input class="form-control" type="text" name="entity_company_new" required disabled/>
        </div>
    </div>

    <div class="form-group">
        <label for="entity_company_new" class="font-weight-bold">My organization isn't listed here:</label>
        <input id="entity_company_new" class="js-new-input-toggle" type="checkbox"/>
    </div>
</div>

<div class="js-owner-container" data-type="investors" style="display: none;">
    <div class="js-existed-input-container">
    @include('discover.listing-requests.entity-forms.includes.select2', [
        'label' => 'Investors list',
        'name' => 'entity_investor_id',
        'items' => $investors,
        'required' => $required,
    ])
    </div>

    <div class="js-new-input-container" style="display: none">
        <div class="form-group">
            <label class="font-weight-bold">New investor name:</label>
            <input class="form-control" type="text" name="entity_investor_new" required disabled/>
        </div>
    </div>

    <div class="form-group">
        <label for="entity_investor_new" class="font-weight-bold">My investor isn't listed here:</label>
        <input id="entity_investor_new" type="checkbox" class="js-new-input-toggle"/>
    </div>
</div>
{{-- Job owner section end --}}

@include('discover.listing-requests.entity-forms.includes.select-multiple', [
    'label' => 'Focus',
    'name' => 'entity_focus',
    'items' => $focusCategories
])

<div class="form-group">
    <label class="font-weight-bold">Job description:</label>
    <textarea class="form-control" name="entity_job_description" {{ $required }}></textarea>
</div>

<div class="form-group">
    <label class="font-weight-bold">Type:</label>
    <select class="custom-select" name="entity_employment_type" {{ $required }}>
        <option selected></option>
        <option>Full Time</option>
        <option>Part Time</option>
        <option>One Time</option>
    </select>
</div>

<div class="form-group">
    <label class="font-weight-bold">Posted Date:</label>
    <input type="date" class="form-control" name="entity_posted_date" value="" {{ $required }}>
</div>

<div class="form-group">
    <label class="font-weight-bold">Salary:</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        <input type="number" name="entity_salary" class="form-control" value="">
    </div>
</div>

<div class="form-group">
    <label class="font-weight-bold">Hourly rate:</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        <input type="number" name="entity_hourly_rate" class="form-control" value="">
    </div>
</div>

<style>
    .entity-to-update .twitter-typeahead {
        width:  100%;
    }
</style>
<link href="{{ asset('packages/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('packages/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({ width: '100%' });

        if ($('.updateEntity').length) {
            let input = $('.updateEntity'),
                actionUrl = input.data('action');

            let names = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: {
                    url: actionUrl,
                }
            });
            names.initialize();

            input.typeahead(null, {
                name: 'people',
                source: names
            });

            input.on('change', function () {
                var name = $(this).val();
                $('input[name=entity_job_title]').val(name);
            });
        }

        $('.js-owner-type-radio').on('change', function (){
            let type = $(this).val();

            $('.js-owner-container').each(function (){
                let ownerTypeContainer = $(this),
                    checkbox = ownerTypeContainer.find('.js-new-input-toggle'),
                    newContainer = ownerTypeContainer.find('.js-new-input-container'),
                    newInput = newContainer.find('input'),
                    existedContainer = ownerTypeContainer.find('.js-existed-input-container'),
                    existedInput = existedContainer.find('select');

                if (ownerTypeContainer.data('type') === type) {
                    checkbox.prop('checked', false);
                    newContainer.hide();
                    newInput.attr('disabled', true);
                    existedContainer.show();
                    existedInput.attr('disabled', false);
                    ownerTypeContainer.show();
                } else {
                    ownerTypeContainer.hide();
                    newInput.attr('disabled', true);
                    existedInput.attr('disabled', true);
                }
            });
        });

        $('.js-new-input-toggle').on('change', function () {
            let checkbox = $(this),
                ownerTypeContainer = $(this).parents('.js-owner-container'),
                newContainer = ownerTypeContainer.find('.js-new-input-container'),
                newInput = newContainer.find('input'),
                existedContainer = ownerTypeContainer.find('.js-existed-input-container'),
                existedInput = existedContainer.find('select');

            if(checkbox.prop('checked')) {
                existedContainer.hide();
                existedInput.attr('disabled', true);
                newContainer.show();
                newInput.attr('disabled', false);
            } else {
                newContainer.hide();
                newInput.attr('disabled', true);
                existedContainer.show();
                existedInput.attr('disabled', false);
            }
        });
    });
</script>
