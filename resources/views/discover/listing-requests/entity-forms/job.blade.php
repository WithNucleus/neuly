@if ($general['update'])
    <div class="form-group mb-4 pb-4 page-title-default entity-to-update">
        <label for="entity_name" class="d-block lead text-center">What job do you want to update?</label>
        <input type="text" class="form-control updateEntity" placeholder="Search for job" data-action="{{ route('discover.jobs.titlesJson') }}" name="entity_update_resource" required>
    </div>
    <script>
        $(document).ready(function() {
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

            input.on('change', function() {
                var name = $(this).val();
                $('input[name=entity_job_title]').val(name);
            });

            $('.js-add-new-company-checkbox').on('change', function () {
                let checkbox = $(this),
                    inputContainer = $('.js-add-new-company-input-container'),
                    input = $('.js-add-new-company-input'),
                    companyInput = $('select[name=entity_company]');

                if(checkbox.prop('checked')) {
                    inputContainer.show();
                    input.attr('disabled', false);
                    companyInput.attr('disabled', true);
                } else {
                    inputContainer.hide();
                    input.attr('disabled', true);
                    companyInput.attr('disabled', false);
                }
            });
        });
    </script>
    <style>
        .entity-to-update .twitter-typeahead {
            width:  100%;
        }
    </style>
    <p class="lead text-center">Updated Job Details</p>
    <div class="form-group">
        <label for="entity_name" class="font-weight-bold">Job title:</label>
        <input type="text" class="form-control" name="entity_job_title" required>
    </div>
@else
    <p class="lead text-center">What job do you want to add?</p>
    <div class="form-group mb-4 pb-4 page-title-default">
        <label for="entity_name" class="sr-only">Job title:</label>
        <input type="text" class="form-control" name="entity_job_title" required>
    </div>
@endif

@include('discover.listing-requests.entity-forms.includes.select', [
    'label' => 'Organisation',
    'name' => 'entity_company',
    'items' => $companies,
    'required' => true,
])

<div class="form-group">
    <label for="entity_company_new" class="font-weight-bold">My organisation isn't listed here:</label>
    <input id="entity_company_new" class="js-add-new-company-checkbox" type="checkbox" name="entity_company_not_exist"/>
</div>

<div class="form-group js-add-new-company-input-container" style="display: none">
    <label class="font-weight-bold">New organisation name:</label>
    <input class="form-control js-add-new-company-input" type="text" name="entity_company_new" required disabled/>
</div>

@include('discover.listing-requests.entity-forms.includes.select-multiple', [
    'label' => 'Focus',
    'name' => 'entity_focus',
    'items' => $focusCategories
])

<div class="form-group">
    <label class="font-weight-bold">Job description:</label>
    <textarea class="form-control" name="entity_job_description"></textarea>
</div>

<div class="form-group">
    <label class="font-weight-bold">Type:</label>
    <select class="custom-select" name="entity_employment_type">
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
