@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h1 class="h2">
            <span class="text-capitalize">Import Results</span>
            <a href="{{ route('import.batch-images-upload.index') }}" class="font-sm"><i class="la la-angle-double-left"></i> Back to <span>Batch Images Upload</span></a>
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

    @include('admin.import.results.clinicaltrial-csv')
@endsection
