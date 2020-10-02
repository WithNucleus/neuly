@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Import</span>
            <a href="/admin/clinicaltrial" class="font-sm"><i class="la la-angle-double-left"></i> Back to <span>Clinical Trials</span></a>
        </h2>
    </div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="row mt-4">

        <div class="col-12 col-md-8 col-xl-6">

            <div class="card card-body">

                <h3 class="h4">Import Clinical Trials</h3>

                <p class="mb-0">
                    <strong>Requirements</strong>
                </p>
                <ul>
                    <li>One CSV file per Focus category</li>
                    <li>Headings must match the database tables</li>
                </ul>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <div class="col-12 col-md-6">
                            <label for="focus_id" class="font-weight-bold">Focus Category</label>
                            <select class="form-control custom-select" name="focus_id" required>
                                <option value="" selected disabled="">--</option>
                                @foreach($focusCats as $focus)
                                    <option value="{{ $focus->id }}">{{ $focus->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="csv" class="font-weight-bold">File</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="csv" id="csv">
                                <label id="csv-label" class="custom-file-label" for="csv">Choose file</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
                            <span>Import</span>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-md-8 col-xl-6 mt-2">

            @isset($importResults)
            <div class="card card-body">
                <h4>Previous Imports</h4>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Focus</th>
                            <th>Actions</th>
                            <th>Failures</th>
                        </tr>
                    </thead>

                    @foreach($importResults as $result)
                        <tr>
                            <td>
                                {{ Carbon\Carbon::parse($result->created_at)->diffForHumans() }}
                            </td>
                            <td>
                                {{ $result->focus->name }}
                            </td>
                            <td>
                                <a href="{{ route('import.results', $result->id) }}" class="btn btn-sm btn-link"><i class="la la-eye"></i> Preview</a>
                            </td>
                            <td>
                                @if($countFailures = $result->failures()->count())
                                    <a href="{{ route('import.failures', $result->id) }}" class="btn btn-sm btn-link">
                                        <i class="la la-eye"></i> {{$countFailures}} failures
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @endisset

            {{-- @isset($record_status)
                <div class="card card-body">
                    <h4>Imported Results</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        @foreach($record_status as $record)
                            <tr>
                                <td>
                                    <a href="/admin/clinicaltrial/{{ $record['id'] }}/show">{{ $record['title'] }}</a>
                                </td>
                                <td>{{ $record['status'] }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endisset --}}
        </div>

    </div>

    <script type="text/javascript" href="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

    <script>
        var input = document.getElementById( 'csv' );
        var infoArea = document.getElementById( 'csv-label' );

        input.addEventListener( 'change', showFileName );

        function showFileName( event ) {

            // the change event gives us the input it occurred in
            var input = event.srcElement;

            // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
            var fileName = input.files[0].name;

            // use fileName however fits your app best, i.e. add it into a div
            infoArea.textContent = fileName;
        }
    </script>

@endsection
