{{-- Modal Layout --}}
@extends('layouts.show-modal')

@section('content')

	<div class="alert alert-danger errors" style="display:none">
        <ul class="mb-0"></ul>
    </div>

    <div class="alert alert-success success" style="display:none">
        <p class="mb-0"></p>
    </div>

	<form action="{{ route('member.bookmarks.store-list') }}" id="create-list" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
	    @csrf

	    <div class="form-group">
	        <label for="name" class="sr-only">List Name</label>
	        <input type="text" class="form-control mr-2 mt-2" name="name" placeholder="List Name" required>
	    </div>

        <div class="form-group">
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_public" id="private" value="0" checked>
                    <label class="form-check-label" for="private">Private</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_public" id="public" value="1">
                    <label class="form-check-label" for="public">Public</label>
                </div>
            </div>
        </div>

	    <div class="form-group">
	        <label for="name" class="sr-only">Description</label>
	        <textarea class="form-control" name="description" placeholder="Description"></textarea>
	    </div>

	    <div class="form-group mb-0">
	        <button type="submit" class="submit mt-2 btn btn-primary">Save</button>
	    </div>

	</form>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script>

		// Ajax Slug Checking
        $(document).ready(function() {
            $(".submit").click(function(e){
                e.preventDefault();

                var _token = $("input[name='_token']").val();
                var name = $("input[name='name']").val();
                var description = $("input[name='description']").val();

                $.ajax({
                    url: "{{ route('member.bookmarks.quick-save') }}",
                    type:'POST',
                    data: {_token:_token, name:name, description:description},
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
                $( "#create-list" ).submit();
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
	</script>

{{-- @include('members.bookmarks.create-list') --}}

@endsection


{{-- Fancy layout --}}
{{-- @extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')

	<div class="container">
		<h1 class="h2"><i class="fad fa-clipboard-list text-info"></i> New Bookmark List</h1>
	    <div class="p-4 bg-white shadow-sm">
			<div class="col-12 col-md-8 col-lg-6">
				@include('members.bookmarks.create-list')
			</div>
		</div>
	</div>

	@include('members.includes.dashboard-end')

@endsection --}}
