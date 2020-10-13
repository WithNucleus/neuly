@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => true])

    <p class="dashboard-actions-container m-2 float-right">
        @include('members.follow.button', [
            'followable_type' => get_class($clinicaltrial),
            'followable_id' => $clinicaltrial->id,
            'name' => $clinicaltrial->title,
        ])

    </p>

    <h1 class="h3 font-normal mb-2">{{ $clinicaltrial->title }}</h1>

    @include('discover.includes.status-messages')

    @if($clinicaltrial->focus->count() > 0)
        <div class="row mb-3">
            <div class="col-12">
                <p class="lead mb-0">
                    <i class="fad fa-flask text-secondarydark"></i> <span class="sr-only">Focus:</span>
                    @foreach ($clinicaltrial->focus as $item)
                        <a href="{{ route('discover.focus.show', $item->slug )}} ">{{ $item->name }}</a>@if (!$loop->last) / @endif
                    @endforeach
                </p>
            </div>
        </div>
    @endif

    <div class="p-4 bg-white shadow-sm">
        @include('discover.clinicaltrials.data')
    </div>

    @include('discover.includes.show-end')

@endsection
