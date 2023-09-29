@extends('layouts.app')

@section('body-class', 'page-user-settings bg-body-secondary')

@section('content')
    @include('navbars.primary')

    <x-members.settings title="Account Settings">
        <form action="{{ route('user.settings.email') }}" method="post" class="needs-validation" novalidate>
            @csrf
            <div class="form-group mb-3 text-uppercase">
                <strong>Current Email:</strong> {{ $currentEmail }}
            </div>
            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <label for="new_email" class="font-weight-bold">New Email</label>
                    <input type="email" class="form-control" id="new_email" name="new_email" required>
                    <div class="invalid-feedback">
                        Please enter your new email.
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <label for="new_email_confirmation" class="font-weight-bold">New Email Confirmation</label>
                    <input type="email" class="form-control" id="new_email_confirmation" name="new_email_confirmation" required>
                    <div class="invalid-feedback">
                        Please confirm your new email.
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <label for="password" class="font-weight-bold">Current Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div class="invalid-feedback">
                        Please enter your password to validate your change request.
                    </div>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-lg btn-primary">Save</button>
            </div>
        </form>
    </x-members.settings>

    @include('footers.mini')
@endsection
