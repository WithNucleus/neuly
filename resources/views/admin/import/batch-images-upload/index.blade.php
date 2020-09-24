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

                        <h3 class="h4">Batch Image Upload for Entities</h3>
                        <p class="mb-0">
                            <strong>Requirements</strong>
                        </p>
                        <ul>
                            <li>One CSV file per Entity type</li>
                            <li>Allowed CSV columns: {{ $allowedColumns }}</li>
                            <li>ZIP should contain all image files in the root level (without folders)</li>
                        </ul>

                        @include('admin.includes.status-messages')

                        <form action="{{ route('import.batch-images-upload.import') }}" method="POST" enctype="multipart/form-data">
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
                            </div>

                            <div class="form-group row">
                                <div class="col-12 col-md-6">
                                    <label class="font-weight-bold">CSV</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input js-custom-file-input" name="csv" id="csv">
                                        <label class="custom-file-label" for="csv">Choose file</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="font-weight-bold">ZIP with images</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input js-custom-file-input" name="images" id="images">
                                        <label class="custom-file-label" for="images">Choose file</label>
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
                                        <a href="{{ route('import.batch-images-upload.results', $result->id) }}" class="btn btn-sm btn-link"><i class="la la-eye"></i> Preview</a>
                                    </td>
                                    <td>
                                        @if($countFailures = $result->failures()->count())
                                            <a href="{{ route('import.batch-images-upload.failures', $result->id) }}" class="btn btn-sm btn-link">
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
    <script>
        $('.js-custom-file-input').on('change', showFileName);

        function showFileName(event) {
            let input = event.target;
            let fileName = input.files[0].name;
            $(input).siblings('label').text(fileName);
        }
    </script>
@endsection
