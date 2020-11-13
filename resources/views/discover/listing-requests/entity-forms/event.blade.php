@if ($general['update'])
    <div id="event-to-update" class="form-group mb-4 pb-4 page-title-default">
        <label for="entity_name" class="d-block lead text-center">What event do you want to update?</label>
        <input type="text" class="form-control updateEntity" placeholder="Events Name" name="entity_update_resource"required>
    </div>
    <script>
        if($('#event-to-update').length > 0) {

            var $input = $('.updateEntity');

            var names = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: {
                    url: '/events/names.json',
                }
            });
            names.initialize();

            $('.updateEntity').typeahead(null, {
                name: 'states',
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
        #event-to-update .twitter-typeahead {
            width:  100%;
        }
    </style>
    <p class="lead text-center">Updated Event Details</p>
    <div class="form-group">
        <label for="entity_name" class="font-weight-bold">Name:</label>
        <input type="text" class="form-control" name="entity_name" required>
    </div>
@else
    <p class="lead text-center">What event do you want to add?</p>
    <div class="form-group mb-4 pb-4 page-title-default">
        <label for="entity_name" class="sr-only">Name:</label>
        <input type="text" class="form-control" name="entity_name" placeholder="Name of Event" required>
    </div>
@endif
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
    <label for="entity_registration" class="font-weight-bold">Registration URL:</label>
    <input type="url" class="form-control" name="entity_registration">
</div>
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group">
            <label for="entity_start" class="font-weight-bold">Start:</label>
            <input type="date" class="form-control" name="entity_start" required>
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="form-group">
            <label for="entity_end" class="font-weight-bold">End:</label>
            <input type="date" class="form-control" name="entity_end">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="entity_description" class="font-weight-bold">Description</label>
    <textarea class="form-control" name="entity_description" rows="3"></textarea>
</div>
