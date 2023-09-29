@extends('layouts.app')

@section('body-class', 'page-user-settings bg-body-secondary')

@section('content')
    @include('navbars.primary')

    <x-members.settings title="Account Settings">
        <form action="{{ route('user.settings.password') }}" method="post" class="needs-validation" novalidate>
            @csrf
            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <label for="new_password" class="font-weight-bold">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <label for="new_password_confirmation" class="font-weight-bold">New Password Confirmation</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <label for="password" class="font-weight-bold">Current Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Required to change password" required>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-lg btn-primary">Save</button>
            </div>
        </form>
    </x-members.settings>
@endsection
