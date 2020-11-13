@if ($general['update'])
    <div id="organisation-to-update" class="form-group mb-4 pb-4 page-title-default">
        <label for="entity_name" class="d-block lead text-center">What organization do you want to update?</label>
        <input type="text" class="w-100 form-control updateEntity" placeholder="Search for organization" name="entity_update_resource" required>
    </div>
    <script>
        if($('#organisation-to-update').length > 0) {

            var $input = $('.updateEntity');

            var names = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: {
                    url: '/organization/names.json',
                }
            });
            names.initialize();

            $('.updateEntity').typeahead(null, {
                name: 'organisations',
                source: names
            });

        }

        $(document).ready(function() {
            $(".updateEntity").on('change', function() {
                var name = $(this).val();
                $('input[name=entity_name]').val(name);
            });
        });
    </script>
    <style>
        #organisation-to-update .twitter-typeahead {
            width:  100%;
        }
    </style>
    <p class="lead text-center">Updated Organization Details</p>
    <div class="form-group">
        <label for="entity_name" class="font-weight-bold">Organization Name:</label>
        <input type="text" class="form-control" name="entity_name" required>
    </div>
@else
    <p class="lead text-center">What organization do you want to add?</p>
    <div class="form-group mb-4 pb-4 page-title-default">
        <label for="entity_name" class="sr-only">Organization Name:</label>
        <input type="text" class="form-control" name="entity_name" placeholder="Name of Organization" required>
    </div>
@endif

<div class="form-group">
    <label for="entity_ownership" class="font-weight-bold">Type:</label>
    <select class="custom-select" name="entity_ownership">
        <option selected></option>
        <option>Public Company</option>
        <option>Privately Held</option>
        <option>Educational Institution</option>
        <option>Government Agency</option>
        <otion>Non-Profit</otion>
    </select>
</div>
@include('discover.listing-requests.entity-forms.includes.select-multiple', [
    'label' => 'Focus',
    'name' => 'entity_focus',
    'items' => $focusCategories
])
<div class="form-group">
    <label for="entity_website" class="font-weight-bold">Website:</label>
    <input type="url" class="form-control" name="entity_website">
</div>
<div class="form-group">
    <label for="entity_ticker_symbol" class="font-weight-bold">Ticker Symbol:</label>
    <input type="text" class="form-control" name="entity_ticker_symbol">
</div>
<div class="form-group">
    <label for="entity_summary" class="font-weight-bold">Summary:</label>
    <textarea class="form-control" name="entity_summary" rows="3"></textarea>
</div>
<div class="form-group">
    <label for="entity_founded_date" class="font-weight-bold">Founded Date:</label>
    <input type="date" class="form-control" name="entity_founded_date">
</div>
<div class="form-group">
    <label for="entity_valuation" class="font-weight-bold">Valuation:</label>
    <input type="number" class="form-control" name="entity_valuation">
</div>
<div class="form-group">
    <label for="entity_total_funding_amount" class="font-weight-bold">Total Funding Amount:</label>
    <input type="number" class="form-control" name="entity_total_funding_amount">
</div>
<div class="form-group">
    <label for="entity_last_funding_date" class="font-weight-bold">Last Funding Date:</label>
    <input type="date" class="form-control" name="entity_last_funding_date">
</div>
<div class="form-group">
    <label for="entity_number_employees" class="font-weight-bold">Number of Employees:</label>
    <input type="number" class="form-control" name="entity_number_employees">
</div>
<div class="form-group">
    <label for="entity_logo" class="d-block font-weight-bold">Logo</label>
    <input type="file" name="entity_logo">
</div>
