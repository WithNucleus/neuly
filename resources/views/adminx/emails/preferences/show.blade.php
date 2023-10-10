@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1 class="h3 mb-4">{{ $preference->email }}</h1>
        <div class="mb-3 fs-6">
            @if($preference->user)
                <div>
                    <span>#{{ $preference->user->id }}</span>
                    <span>{{ $preference->user->fullname }}</span>
                </div>
            @else
                <div>Not registered</div>
            @endif
        </div>
        <div class="mb-3 fs-6">
            <div>
                <i class="{{ $preference->marketing_icon }} me-1"></i>
                <span>{{ $preference->marketing_label }}</span>
            </div>
            @if($preference->do_not_email)
                <div class="mt-3">
                    <i class="{{ $preference->blacklist_icon }} me-1"></i>
                    <span>{{ $preference->blacklist_label }}</span>
                </div>
            @endif
        </div>
    </div>
@endsection
