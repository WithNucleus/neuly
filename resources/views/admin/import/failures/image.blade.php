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
                <h3 class="h4">Failures of Images</h3>
                <ul class="list-group">
                    @forelse($failures as $failure)
                        <li class="list-group-item js-failure-item-container">
                            @foreach ($failure->details as $key => $detail)
                                <p>{{ strtoupper($key) }} : {{ $detail }}</p>
                            @endforeach
                            <div class="form-group row">
                                <div class="col-12 col-md-6">
                                    <label class="font-weight-bold">Upload image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input js-custom-file-input" name="image" id="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary js-fix-image-failure-button"
                                    data-action="{{ route('import.failures.fix', $failure->id) }}">Add image
                            </button>
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
