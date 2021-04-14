@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Import People</span>
        </h2>
    </div>
@endsection

@section('content')
    @include('admin.includes.status-messages')

    <div class="row">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card card-body">
                <form action="{{ route('admin.import.people.process') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <p class="mb-0">
                        <strong>Requirements</strong>
                    </p>
                    <ul>
                        <li>CSV should contain at least one of "id" and "name" columns.</li>
                        <li>All column names in the CSV must match the database.</li>
                    </ul>

                    <div class="form-group">
                        <label for="csv">File</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input js-custom-file-input" name="csv">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script>
        $('.js-custom-file-input').on('change', function (event) {
            let input = event.target;
            let fileName = input.files[0].name;
            $(input).siblings('label').text(fileName);
        });
    </script>
@endsection
