@extends('layouts.app')

@section('body-class', 'page-user-settings bg-light')

@section('content')
    @include('navbars.primary')

    <div class="container">
        <main id="content-main" role="main" class="col-12">
            <div class="row">
                <div class="col-12 col-xl-10 mx-auto bg-white p-4 shadow-sm">

                    <h1 class="page-title-default text-primary mb-4">Account Settings</h1>

                    @include('navbars.tabs-user-settings')

                    <div class="py-4 col-12 col-lg-8">
                        @include('members.includes.status-messages')

                        <form action="{{ route('user.settings.email') }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-group mb-3">
                                <strong>Current Email:</strong> {{ $currentEmail }}
                            </div>
                            <div class="form-group mb-3">
                                <label for="new_email" class="font-weight-bold">New Email</label>
                                <input type="email" class="form-control" name="new_email" placeholder="Enter your new email" required>
                                <div class="invalid-feedback">
                                    Please enter your new email.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="new_email_confirmation" class="font-weight-bold">New Email Confirmation</label>
                                <input type="email" class="form-control" name="new_email_confirmation" placeholder="Confirm your new email" required>
                                <div class="invalid-feedback">
                                    Please confirm your new email.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="font-weight-bold">Current Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Confirm your email change with your current password" required>
                                <div class="invalid-feedback">
                                    Please enter your password to validate your change request.
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                        <script>
                            // Example starter JavaScript for disabling form submissions if there are invalid fields
                            (function() {
                                'use strict';
                                window.addEventListener('load', function() {
                                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                    var forms = document.getElementsByClassName('needs-validation');
                                    // Loop over them and prevent submission
                                    var validation = Array.prototype.filter.call(forms, function(form) {
                                        form.addEventListener('submit', function(event) {
                                            if (form.checkValidity() === false) {
                                                event.preventDefault();
                                                event.stopPropagation();
                                            }
                                            form.classList.add('was-validated');
                                        }, false);
                                    });
                                }, false);
                            })();
                        </script>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('footers.mini')
@endsection
