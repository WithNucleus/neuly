@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>Neuly User</h1>
        <table class="table w-auto">
            <tr>
                <th class="text-uppercase">Name</th>
                <td>{{ $user->full_name }}</td>
            </tr>
            <tr>
                <th class="text-uppercase">Email</th>
                <td>
                    <div>
                        @if($user->email_verified_at)
                            <i class="fa-sharp fa-solid fa-envelope-circle-check fa-fw text-accent"></i>
                        @else
                            <i class="fa-sharp fa-solid fa-reply-clock fa-fw text-danger"></i>
                        @endif
                        <span>{{ $user->email }}</span>
                    </div>

                    <div>
                        <div>
                            <i class="{{ $user->emailPreference->marketing_icon }}"></i>
                            <a href="{{ route('adminx.emails.preferences.show', $user->emailPreference->id) }}">{{ $user->emailPreference->marketing_label }}</a>
                        </div>
                        @if($user->emailPreference->do_not_email)
                            <div>
                                <i class="{{ $user->emailPreference->blacklist_icon }}"></i>
                                <span>{{ $user->emailPreference->blacklist_label }}</span>
                            </div>
                        @endif
                    </div>
                </td>
            </tr>
            <tr>
                <th class="text-uppercase">Member URL</th>
                <td>{{ $user->member_url }}</td>
            </tr>
            <tr>
                <th class="text-uppercase">Roles</th>
                <td>
                    @foreach($user->roles as $role)
                        <span class="badge {{ $role->color }} mb-1 me-1">{{ $role->name }}</span>
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
@endsection
