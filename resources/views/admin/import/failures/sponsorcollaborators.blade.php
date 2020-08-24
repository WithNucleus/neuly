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
                            <p class="alert alert-danger mt-2 d-none">Unknown Error</p>
                        </li>
                    @empty
                        <li class="list-group-item">No failures for this type.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        $(".js-fix-sponsor-failure-button").on('click', function () {
            let button = $(this),
                itemBlock = button.parent(),
                model = button.data('model'),
                action = button.data('action');

            $.post(action, {'model' : model}, function (response){
                if (response.status == 'success') {
                    itemBlock.slideUp();
                } else {
                    itemBlock.find('.alert').removeClass('d-none');
                }
            });
        });
    </script>
@endsection

