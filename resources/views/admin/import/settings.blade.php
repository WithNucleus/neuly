@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Import</span>
            <a href="{{ route('clinicaltrial.index') }}" class="font-sm"><i class="la la-angle-double-left"></i> Back to <span>Clinical Trials</span></a>
        </h2>
    </div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="row mt-4">
        <div class="col-12 col-md-8 col-xl-6">
            <div class="card card-body">
                <h3 class="h4">Import Settings</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <form action="{{ route('import.settings.update') }}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <div class="col-12">
                            <label for="mapping_organisation" class="font-weight-bold">Organisation mapping</label>
                            <p>List of comma separated words that appear in the names of organizations <br>(column "Sponsor/Collaborators" in CSV)</p>
                            <textarea id="mapping_organisation" name="mapping_organisation" class="form-control" required>{{ $importSettings ? implode(',', $importSettings->mapping_organisation) : '' }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
                            <span>Save</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
