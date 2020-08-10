@if ($general['update'] === "true")
    <div id="people-to-update" class="form-group mb-4 pb-4 page-title-default">
        <label for="entity_name" class="d-block lead text-center">What person do you want to update?</label>
        <input type="text" class="form-control updateEntity" placeholder="Search for person" name="entity_update_resource" required>
    </div>
    <script>
        if($('#people-to-update').length > 0) {

            var $input = $('.updateEntity');

            var names = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: {
                    url: '/people/names.json',
                }
            });
            names.initialize();

            $('.updateEntity').typeahead(null, {
                name: 'people',
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
        #people-to-update .twitter-typeahead {
            width:  100%;
        }
    </style>
    <p class="lead text-center">Updated Person Details</p>
    <div class="form-group">
        <label for="entity_name" class="font-weight-bold">Name:</label>
        <input type="text" class="form-control" name="entity_name" required>
    </div>
@else
    <p class="lead text-center">What person do you want to add?</p>
    <div class="form-group mb-4 pb-4 page-title-default">
        <label for="entity_name" class="sr-only">Name:</label>
        <input type="text" class="form-control" name="entity_name" placeholder="Name of Person" required>
    </div>
@endif

<div class="form-group">
    <label for="entity_email" class="font-weight-bold">Email:</label>
    <input type="email" class="form-control" name="entity_email">
</div>
<div class="form-group">
    <label for="entity_website" class="font-weight-bold">Website:</label>
    <input type="url" class="form-control" name="entity_website">
</div>
<div class="form-group">
    <label for="entity_linkedin" class="font-weight-bold">Linkedin:</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">https://www.linkedin.com/in/</span>
        </div>
        <input type="text" class="form-control" name="entity_linkedin">
    </div>
</div>
<div class="form-group">
    <label for="entity_facebook" class="font-weight-bold">Facebook:</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">https://www.facebook.com/</span>
        </div>
        <input type="text" class="form-control" name="entity_facebook">
    </div>
</div>
<div class="form-group">
    <label for="entity_instagram" class="font-weight-bold">Twitter:</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">https://www.twitter.com/</span>
        </div>
        <input type="text" class="form-control" name="entity_twitter">
    </div>
</div>
<div class="form-group">
    <label for="entity_bio" class="font-weight-bold">Bio</label>
    <textarea class="form-control" name="entity_bio" rows="3"></textarea>
</div>
<div class="form-group">
    <label for="entity_photo" class="d-block font-weight-bold">Photo</label>
    <input type="file" name="entity_photo">
</div>
