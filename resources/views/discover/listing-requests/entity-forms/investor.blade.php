@if ($general['update'] === "true")
    <div id="investor-to-update" class="form-group mb-4 pb-4 page-title-default">
        <label for="entity_name" class="d-block lead text-center">What investor do you want to update?</label>
        <input type="text" class="form-control updateEntity" placeholder="Search for investor" name="entity_update_resource" required>
    </div>
    <script>
        if($('#investor-to-update').length > 0) {

            var $input = $('.updateEntity');

            var names = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: {
                    url: '/investor/names.json',
                }
            });
            names.initialize();

            console.log(names);

            $('.updateEntity').typeahead(null, {
                name: 'investors',
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
        #investor-to-update .twitter-typeahead {
            width:  100%;
        }
    </style>
    <p class="lead text-center">Updated Investor Details</p>
    <div class="form-group">
        <label for="entity_name" class="font-weight-bold">Name:</label>
        <input type="text" class="form-control" name="entity_name" required>
    </div>
@else
    <p class="lead text-center">What investor do you want to add?</p>
    <div class="form-group mb-4 pb-4 page-title-default">
        <label for="entity_name" class="sr-only">Name:</label>
        <input type="text" class="form-control" name="entity_name" placeholder="Name of Investor" required>
    </div>
@endif
<div class="form-group">
    <label for="entity_website" class="font-weight-bold">Website:</label>
    <input type="url" class="form-control" name="entity_website">
</div>
<div class="form-group">
    <label for="entity_type" class="font-weight-bold">Type:</label>
    <select class="custom-select" name="entity_type">
        <option selected></option>
        <option>Venture Capital</option>
        <option>Private Equity</option>
        <option>Private Individual</option>
    </select>
</div>
