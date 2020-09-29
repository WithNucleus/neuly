@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Import Failures</span>
            <a href="{{ route('import.batch-images-upload.index') }}" class="font-sm"><i class="la la-angle-double-left"></i> Back to <span>Batch Images Upload</span></a>
        </h2>
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
        <div class="col-12 col-md-6">
            <div class="card card-body">
                <h3 class="h5">Failures by type</h3>
                <ul class="list-group">
                @forelse($failuresTotalByType as $type => $total)
                    <li class="list-group-item">
                        <a href="{{ route('import.failures.showByType', [$result->id, $type]) }}">{{ ucfirst($type) }} failures ({{ $total }})</a>
                    </li>
                @empty
                    <li class="list-group-item">No records.</li>
                @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
