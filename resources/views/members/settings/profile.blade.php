@extends('layouts.app')

@section('body-class', 'page-user-settings bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container">
        <main id="content-main" role="main" class="col-12">
            <div class="row">
                <div class="col-12 col-xl-10 mx-auto bg-white p-4">

                    <h1 class="page-title-default text-primary mb-4">Account Settings</h1>

                    @include('navbars.tabs-user-settings')

                    <div class="py-4 col-12 col-lg-8">

                        <div class="alert alert-danger errors alert-dismissible fade show" style="display:none">
                            <ul class="plain-list mb-0 font-small"></ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        @include('members.includes.status-messages')

                        <form id="user-profile" action="{{ route('user.settings') }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-group row mb-3">
                                <div class="col-12 col-md-6 mb-3 mb-md-0">
                                    <label for="new_name" class="font-weight-bold">First Name</label>
                                    <input type="text" class="form-control" name="new_name" value="{{ $user->name }}" required>
                                    <div class="invalid-feedback">
                                        Your first name is required.
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="last_name" class="font-weight-bold">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" required>
                                    <div class="invalid-feedback">
                                        Your last name is required.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="member_url" class="font-weight-bold">Member URL</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">neuly.com/member/</div>
                                    </div>
                                    <input type="member_url" class="form-control" name="member_url" value="{{old('member_url', $user->member_url)}}" required aria-describedby="memberUrlHelpBlock">
                                </div>
                                <small id="memberUrlHelpBlock" class="form-text text-muted">
                                    If want to share anything publicly or with the Neuly community, you'll need a member URL
                                </small>
                            </div>

                            <button type="submit" class="submit btn btn-primary">Save</button>
                        </form>

                        <script>
                            $(document).ready(function() {

                                $('.alert').alert();

                                // Ajax Member URL Checking
                                $(".submit").click(function(e){
                                    e.preventDefault();

                                    var _token = $("input[name='_token']").val();
                                    var member_url = $("input[name='member_url']").val();

                                    $.ajax({
                                        url: "{{ route('user.validate.member_url') }}",
                                        type:'POST',
                                        data: {_token:_token, member_url:member_url},
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

                                    // submit the form
                                    $( "#user-profile" ).submit();
                                }

                                function printErrorMessage (message) {

                                    $(".errors").find("ul").html('');
                                    $(".errors").css('display','block');

                                    $.each( message, function( key, value ) {
                                        $(".errors").find("ul").append('<li>' + value + '</li>');
                                    });

                                    // add invalid tag to slug field
                                    $("input[name='member_url']").addClass('is-invalid');

                                    // scroll to top
                                    $([document.documentElement, document.body]).animate({
                                        scrollTop: $("#app").offset().top
                                    });
                                }

                            });
                        </script>

                    </div>

                </div>
            </div>
        </main>
    </div>

    @include('footers.mini')

@endsection
