<script>

    // Ajax Slug Checking
    $(document).ready(function() {
        $(".submit").click(function(e){
            e.preventDefault();

            var _token = $("input[name='_token']").val();
            var title = $("input[name='title']").val();
            var slug = $("input[name='slug']").val();
            
            @isset($note)
                var note_id = {{ $note->id }};
            @else
                var note_id = 'new';
            @endisset

            $.ajax({
                url: "{{ route('member.notes.validate') }}",
                type:'POST',
                data: {_token:_token, title:title, slug:slug, note_id: note_id},
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        printSuccessMessage(data.success);
                    }else{
                        printErrorMessage(data.error);
                    }
                }
            });

        }); 

        function printSuccessMessage (message) {
            $(".success").find("p").html(message);
            $(".success").css('display','block');

            // show validation on form
            $("input[name='slug']").addClass('is-valid');
            $('.valid-feedback').show();

            // clear any errors
            $(".errors").find("ul").html('');
            $(".errors").css('display','none');

            // submit the form
            $( "#create-note" ).submit();
        }

        function printErrorMessage (message) {
            $(".errors").find("ul").html('');
            $(".errors").css('display','block');

            $.each( message, function( key, value ) {
                $(".errors").find("ul").append('<li>' + value + '</li>');
            });

            // add invalid tag to slug field
            $("input[name='slug']").addClass('is-invalid');

            // scroll to top
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#app").offset().top
            });
        }
    });

    // Slug
    window.onload = function () {

        // Get Field Name to Listen for Updating the Slug, otherwise default to 'name'
        var field_name = 'title';

        // Set Event Listener on Name Field
        document.getElementsByName(field_name)[0].addEventListener('input', updateName);

        // Update Slug Field Function
        function updateName(e) {

            var newSlug = '';

            // Get Name
            var nameValue = document.getElementsByName(field_name)[0].value;

            // Slugify
            if (nameValue) {
                newSlug = slugify(nameValue);
            }

            // Update Slug Field
            document.getElementsByName('slug')[0].value = newSlug;

        }

        // Slugify Function
        function slugify(string) {

            const a = 'àáâäæãåāăąçćčđďèéêëēėęěğǵḧîïíīįìłḿñńǹňôöòóœøōõőṕŕřßśšşșťțûüùúūǘůűųẃẍÿýžźż·/_,:;'
            const b = 'aaaaaaaaaacccddeeeeeeeegghiiiiiilmnnnnoooooooooprrsssssttuuuuuuuuuwxyyzzz------'
            const p = new RegExp(a.split('').join('|'), 'g')

            return string.toString().toLowerCase()
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
                .replace(/&/g, '-and-') // Replace & with 'and'
                .replace(/[^\w\-]+/g, '') // Remove all non-word characters
                .replace(/\-\-+/g, '-') // Replace multiple - with single -
                .replace(/^-+/, '') // Trim - from start of text
                .replace(/-+$/, '') // Trim - from end of text
        }

    }

</script>