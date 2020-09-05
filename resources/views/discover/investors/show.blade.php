@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => false])

        <p class="dashboard-actions-container m-2 float-right">
            @include('members.follow.button', [
                'followable_type' => get_class($investor),
                'followable_id' => $investor->id,
                'name' => $investor->name,
            ])
        </p>

        <h1>{{ $investor->name }}</h1>

        @include('discover.includes.status-messages')

        @include('discover.investors.data')

        <p class="mb-0">
            <small>Last updated: {{ Carbon\Carbon::parse($investor->updated_at)->format('M d, Y') }}</small>
        </p>

        @if(count($related) > 0)

            <h4 class="mt-5">Related Investors:</h4>
            <div class="card-deck mt-2">
                @foreach($related as $index => $item)
                    <div class="card">
                        <div class="card-header"><a href="{{ route('discover.organizations.show', ['slug' => $item->slug]) }}">{{$item->name}}</a></div>
                        <div class="card-body">
                        </div>
                        <div class="card-footer">
                            <strong>Focus:</strong><br>
                            @foreach ($item->focus as $focus)
                                <a href="{{ route('discover.focus.show', $focus->slug) }}">{{ $focus->name }}</a>@if (!$loop->last),@endif
                            @endforeach
                        </div>
                    </div>
                    @if($index%2 === 1)
            </div>
            <div class="card-deck mt-4">
                @endif
                @endforeach
            </div>
        @endif

    @include('discover.includes.show-end')

@endsection
