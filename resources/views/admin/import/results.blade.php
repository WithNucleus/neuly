@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h1 class="h2">
            <span class="text-capitalize">View Import Results</span>

            @if($results->entity == 'Clinical Trials')
                <a href="/admin/import/clinicaltrials" class="font-sm"><i class="la la-angle-double-left"></i> Back to <span>Import Clinical Trials</span></a>
            @elseif($results->entity == 'Research')
                <a href="/admin/import/research" class="font-sm"><i class="la la-angle-double-left"></i> Back to <span>Import Research</span></a>
            @endif
        </h1>
    </div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="row mt-4">
        <div class="col-6 col-md-4">
            <h2 class="h3">#{{ $results->id }} {{ $results->entity }}</h2>
                
            @if($results->focus->name != '')
                <p class="h5 mt-2 mb-3">
                    Focus: {{ $results->focus->name }}
                </p>
            @endif
        </div>
    </div>

    {{-- Research API Results --}}
    @if($results->entity == 'Research')
        @include('admin.import.results.api-results')
    @endif

    {{-- Location Messages --}}
    @isset($location_messages)
        @include('admin.import.results.location-messages')
    @endisset

    {{-- Clinical Trial CSV Table --}}
    @if($results->entity == 'Clinical Trials')
        @include('admin.import.results.clinicaltrial-csv')
    @endif
    

@endsection