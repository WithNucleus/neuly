@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Import Failures by type</span>
            <a href="{{ url()->previous() }}" class="font-sm"><i
                    class="la la-angle-double-left"></i> Back to
                <span>Import failures</span></a>
        </h2>
    </div>
@endsection

@section('content')
    <div class="row mt-1">
        <div class="col-12 col-md-6">
            <div class="card card-body">
                <h3 class="h4">Failures of People Organisation</h3>
                <ul class="list-group">
                    @forelse($failures as $failure)
                        <li class="list-group-item js-failure-item-container">
                            @foreach ($failure->details as $key => $detail)
                                @if(is_array($detail))
                                    <p>{{ strtoupper($key) }}:</p>
                                    <ul class="mb-4">
                                    @foreach ($detail as $name => $value)
                                        <li>{{ strtoupper($name) }}: {{ $value }}</li>
                                    @endforeach
                                    </ul>
                                @else
                                <p>{{ strtoupper($key) }}: {{ $detail }}</p>
                                @endif
                            @endforeach
                            <button class="btn btn-danger js-delete-failure-button"
                                    data-action="{{ route('import.failures.delete', $failure->id) }}">Delete
                            </button>
                            <p class="alert alert-danger mt-2 js-fix-action-error" style="display: none;">Action Error</p>
                        </li>
                    @empty
                        <li class="list-group-item">No failures for this type.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    @include('admin.import.failures.includes.scripts')
@endsection
