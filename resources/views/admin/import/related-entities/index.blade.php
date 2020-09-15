@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Import</span>
        </h2>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-8 col-xl-6">

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card card-body">

                        <h3 class="h4">Import Related Entities</h3>
                        <p class="mb-0">
                            <strong>Requirements</strong>
                        </p>
                        <ul>
                            <li>One CSV file per Entity type</li>
                        </ul>

                        @include('admin.includes.status-messages')

                        <form action="{{ route('import.related-entities.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <div class="col-12 col-md-6">
                                    <label class="font-weight-bold">Target Entity Type</label>
                                    <select class="form-control custom-select" name="entity_type" required>
                                        <option></option>
                                        @foreach($entityTypes as $alias => $entity)
                                            <option value="{{ $entity }}">{{ ucfirst($alias) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="font-weight-bold">CSV File</label>
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

            <div class="row mt-2">
                <div class="col-12">
                    <div class="card card-body">
                        <h4>Previous Imports</h4>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Target Entity</th>
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
                                        {{ class_basename($result->entity) }}
                                    </td>
                                    <td>
                                        <a href="{{ route('import.related-entities.results', $result->id) }}" class="btn btn-sm btn-link"><i class="la la-eye"></i> Preview</a>
                                    </td>
                                    <td>
                                        @if($countFailures = $result->failures()->count())
                                            <a href="{{ route('import.related-entities.failures', $result->id) }}" class="btn btn-sm btn-link">
                                                <i class="la la-eye"></i> {{$countFailures}} failures
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('after_scripts')
    <script type="text/javascript"
            href="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

    <script>
        var input = document.getElementById('csv');
        var infoArea = document.getElementById('csv-label');

        input.addEventListener('change', showFileName);

        function showFileName(event) {

            // the change event gives us the input it occurred in
            var input = event.srcElement;

            // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
            var fileName = input.files[0].name;

            // use fileName however fits your app best, i.e. add it into a div
            infoArea.textContent = fileName;
        }
    </script>
@endsection
