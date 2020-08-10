@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Companies</span>
            <small id="datatable_info_stack">related to {{ $person->name }}</a></small>
            <a href="/admin/company/{{ $person->id }}/show" class="font-sm"><i class="la la-angle-double-left"></i> Back to <span>Company</span></a>
        </h2>
    </div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="row mt-4">

        <div class="col-12 col-md-8 col-xl-6">

            <div class="card card-body">

                <h3 class="h5">Add a Company</h3>

                <form action="" method="POST">
                    @csrf

                    <div class="form-group row">
                        <div class="col-12 col-md-6">
                            <label for="company" class="font-weight-bold">Company</label>
                            <select class="form-control custom-select" name="company" required>
                                <option value="" selected disabled="">--</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="position" class="font-weight-bold">Position</label>
                            <input type="text" class="form-control" name="position" placeholder="Position" required>
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

        <div class="col-12 col-md-8 col-xl-4">

            <div class="card card-body">

                <h3 class="h5">Current Companies</h3>

                @foreach($person->companies as $company)
                    <a href="/admin/company/{{ $company->id }}/show">{{ $company->name }} ({{ $company->getOriginal('pivot_position') }})</a> @if (!$loop->last) <br> @endif
                @endforeach

            </div>
        </div>
    </div>

@endsection
