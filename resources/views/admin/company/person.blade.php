@extends(backpack_view('blank'))

@section('header')
  <div class="container-fluid mt-5">
    <h2>
      <span class="text-capitalize">People</span>
      <small id="datatable_info_stack">related to {{ $company->name }}</small>
      <a href="/admin/company/{{ $company->id }}/show" class="font-sm"><i class="la la-angle-double-left"></i> Back to <span>Company</span></a>
    </h2>
  </div>
@endsection

@section('content')
<!-- Default box -->
  <div class="row mt-4">

       <div class="col-12 col-md-8 col-xl-6">

            <div class="card card-body">

                <h3 class="h5">Atach a Person to <strong>{{ $company->name }}</strong></h3>

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

                <h3 class="h5">Current People</h3>

                @foreach($company->people as $person)
                    <div class="d-flex justify-content-between">
                      <a href="/admin/person/{{ $person->id }}/show">{{ $person->name }} ({{ $person->getOriginal('pivot_position') }})</a>
                      <a class="small" onclick="return confirm_action()" href="{{ route('admin.company.person.remove', ['company_id' => $company->id, 'person_id' => $person->id]) }}">
                        <i class="la la-trash"></i> Remove
                      </a>
                    </div>
                @endforeach

            </div>
       </div>
</div>

<script>
    function confirm_action() {
        return confirm('are you sure?');
    }
</script>

@endsection
