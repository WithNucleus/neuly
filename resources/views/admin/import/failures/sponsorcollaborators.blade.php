@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Import</span>
            <a href="{{ route('import.failures', $importResultId) }}" class="font-sm"><i
                    class="la la-angle-double-left"></i> Back to
                <span>Import failures</span></a>
        </h2>
    </div>
@endsection

@section('content')
    <div class="row mt-1">
        <div class="col-12 col-md-6">
            <div class="card card-body">
                <h3 class="h4">Failures of Sponsor/Collaborators</h3>
                <ul class="list-group">
                    @forelse($failures as $failure)
                        <li class="list-group-item">
                            @foreach ($failure->details as $key => $detail)
                                <p>{{ strtoupper($key) }} : {{ $detail }}</p>
                            @endforeach
                            <button class="btn btn-primary js-fix-sponsor-failure-button"
                                    data-model="{{ \App\Models\Company::class }}"
                                    data-action="{{ route('import.failures.fix', $failure->id) }}">Add to Organisation
                            </button>
                            <button class="btn btn-primary js-fix-sponsor-failure-button"
                                    data-model="{{ \App\Models\Person::class }}"
                                    data-action="{{ route('import.failures.fix', $failure->id) }}">Add to People
                            </button>
                            <button class="btn btn-danger js-delete-failure-button"
                                    data-action="{{ route('import.failures.delete', $failure->id) }}">Delete
                            </button>
                            <p class="alert alert-danger mt-2 d-none">Action Error</p>
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
