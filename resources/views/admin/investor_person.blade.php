@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">People</span>
            <small id="datatable_info_stack">related to {{ $investor->name }}</a></small>
            <a href="/admin/investor/{{ $investor->id }}/show" class="font-sm"><i class="la la-angle-double-left"></i> Back to <span>Company</span></a>
        </h2>
    </div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="row mt-4">

        <div class="col-12 col-md-8 col-xl-6">

            <div class="card card-body">

                <h3 class="h5">Add a Person</h3>

                <form action="" method="POST">
                    @csrf

                    <div class="form-group row">
                        <div class="col-12 col-md-6">
                            <label for="person" class="font-weight-bold">Person</label>
                            <select class="form-control custom-select" name="person" required>
                                <option value="" selected disabled="">--</option>
                                @foreach ($people as $person)
                                    <option value="{{ $person->id }}">{{ $person->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="position" class="font-weight-bold">Role</label>
                            <input type="text" class="form-control" name="role" placeholder="Position" required>
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

                <h3 class="h5">Current People</h3>

                @foreach($investor->people as $person)
                    <a href="/admin/person/{{ $person->id }}/show">{{ $person->name }} ({{ $person->getOriginal('pivot_role') }})</a> @if (!$loop->last) <br> @endif
                @endforeach

            </div>
        </div>
    </div>

@endsection
