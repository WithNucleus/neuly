@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h1 class="h2">
            <span class="text-capitalize">View Import Results</span>

            <a href="/admin/import/research" class="font-sm"><i class="la la-angle-double-left"></i> Back to <span>Import Research</span></a>
        </h1>
    </div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="row mt-4">
        <div class="col-6 col-md-4">
            <h2 class="h3">Focus: {{ $focus->name }}</h2>

        </div>
    </div>

    {{-- Research API Results --}}
    @include('admin.import.results.api-results')
    

@endsection