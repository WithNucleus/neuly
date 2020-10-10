@extends(backpack_view('blank'))

@section('header')
  <div class="container-fluid mt-5">
    <h2>
      <span class="text-capitalize">Parent organisations</span>
      <small id="datatable_info_stack">related to {{ $company->name }}</small>
      <a href="{{ route('company.show', $company->id) }}" class="font-sm"><i class="la la-angle-double-left"></i> Back to <span>Company</span></a>
    </h2>
  </div>
@endsection

@section('content')
<!-- Default box -->
  <div class="row mt-4">

       <div class="col-12 col-md-8 col-xl-6">

            <div class="card card-body">

                <h3 class="h5">Attach Parent Organisation to <strong>{{ $company->name }}</strong></h3>

                <form action="{{ route('admin.company.parent.store', $company->id) }}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <div class="col-12 col-md-6">
                            <label for="parent_id" class="font-weight-bold">Parent Organisation</label>
                            <select id="parent_id" class="form-control select2" name="parent_id" required>
                                <option value="" selected disabled></option>
                                @foreach ($companiesList as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="font-weight-bold">Type</label>
                            <select class="form-control" name="type" required>
                                <option value="" selected disabled></option>
                                @foreach ($types as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
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

                <h3 class="h5">Current Parent Organisations</h3>

                @include('admin.company.partials.related-companies-list', [
                    'companies' => $company->parents,
                    'currentCompanyId' => $company->id,
                    'actionRouteName' => 'admin.company.parent.remove'
                ])

            </div>
       </div>
</div>
@endsection

@section('after_scripts')
    <link href="{{ asset('packages/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('packages/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2();
        });
    </script>
@endsection
