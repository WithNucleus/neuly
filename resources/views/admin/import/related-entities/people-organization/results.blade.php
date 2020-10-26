@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h1 class="h2">
            <span class="text-capitalize">Success Import Results</span>

            <a href="{{ route('import.related-entities.people-organization.index') }}" class="font-sm"><i class="la la-angle-double-left"></i> Back to <span>Import Related People To Organization</span></a>
        </h1>
    </div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="row mt-4">
        <div class="col-6 col-md-4">
            <h2 class="h3">#{{ $result->id }}</h2>
        </div>
    </div>

    @if($peopleMessages)
    <div class="row mt-1">
    @include('admin.import.related-entities.includes.messages', [
        'type' => 'People',
        'messages' => $peopleMessages
    ])
    </div>
    @endif

    @include('admin.import.results.clinicaltrial-csv')
@endsection
