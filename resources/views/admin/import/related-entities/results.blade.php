@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h1 class="h2">
            <span class="text-capitalize">Success Import Results</span>

            <a href="{{ route('import.related-entities.index') }}" class="font-sm"><i class="la la-angle-double-left"></i> Back to <span>Import Related Entities</span></a>
        </h1>
    </div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="row mt-4">
        <div class="col-6 col-md-4">
            <h2 class="h3">#{{ $result->id }} Target entity: {{ class_basename($result->entity) }}</h2>
        </div>
    </div>

    <div class="row mt-1">
    {{-- Location Messages --}}
    @isset($locationMessages)
        @include('admin.import.related-entities.includes.messages', [
            'type' => 'Locations',
            'messages' => $locationMessages
        ])
    @endisset
    </div>

    @include('admin.import.results.clinicaltrial-csv')
@endsection
