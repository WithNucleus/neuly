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

<div class="js-existed-companies-input-container">
    @if ($general['update'])
        @include('discover.listing-requests.entity-forms.includes.select2', [
            'label' => 'Organization',
            'name' => 'entity_company',
            'items' => $companies,
            'required' => false,
        ])
    @else
        @include('discover.listing-requests.entity-forms.includes.select2', [
            'label' => 'Organization',
            'name' => 'entity_company',
            'items' => $companies,
            'required' => true,
        ])
    @endif
</div>

<div class="js-new-company-input-container" style="display: none">
    <div class="form-group">
        <label class="font-weight-bold">New organization name:</label>
        <input class="form-control" type="text" name="entity_company_new" required disabled/>
    </div>
</div>

<div class="form-group">
    <label for="entity_company_new" class="font-weight-bold">My organization isn't listed here:</label>
    <input id="entity_company_new" class="js-new-company-checkbox" type="checkbox"/>
</div>

@include('discover.listing-requests.entity-forms.includes.select-multiple', [
    'label' => 'Focus',
    'name' => 'entity_focus',
    'items' => $focusCategories
])

<div class="form-group">
    <label class="font-weight-bold">Job description:</label>
    <textarea class="form-control" name="entity_job_description" @if (!$general['update']) required @endif></textarea>
</div>

<div class="form-group">
    <label class="font-weight-bold">Type:</label>
    <select class="custom-select" name="entity_employment_type" @if (!$general['update']) required @endif>
        <option selected></option>
        <option>Full Time</option>
        <option>Part Time</option>
        <option>One Time</option>
    </select>
</div>

<div class="form-group">
    <label class="font-weight-bold">Posted Date:</label>
    <input type="date" class="form-control" name="entity_posted_date" value="">
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
        $('.select2').select2();

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

        $('.js-new-company-checkbox').on('change', function () {
            let checkbox = $(this),
                newCompanyContainer = $('.js-new-company-input-container'),
                newCompanyInput = newCompanyContainer.find('input'),
                existedCompaniesContainer = $('.js-existed-companies-input-container'),
                existedCompaniesSelect = existedCompaniesContainer.find('select');

            if(checkbox.prop('checked')) {
                existedCompaniesContainer.hide();
                existedCompaniesSelect.attr('disabled', true);
                newCompanyContainer.show();
                newCompanyInput.attr('disabled', false);
            } else {
                newCompanyContainer.hide();
                newCompanyInput.attr('disabled', true);
                existedCompaniesContainer.show();
                existedCompaniesSelect.attr('disabled', false);
            }
        });
    });
</script>
