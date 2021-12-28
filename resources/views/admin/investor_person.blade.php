@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">People</span>
            <small id="datatable_info_stack">related to {{ $investor->name }}</a></small>
            <a href="/admin/investor/{{ $investor->id }}/show" class="font-sm"><i class="la la-angle-double-left"></i> Back to <span>Investor</span></a>
        </h2>
    </div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="row mt-4">

        <div class="col-12 col-md-8 col-xl-6">

            <div class="card card-body">

                <h3 class="h5">Add a Person</h3>

                @include('members.includes.status-messages')

                <form action="" method="POST">
                    @csrf

                    <div class="form-group row">
                        <div class="col-12 col-md-6">
                            <label for="person" class="font-weight-bold d-block">Person</label>

                            <input type="text" class="w-100 form-control findPerson" placeholder="Search for person" name="person" required>
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
                    <div class="d-flex justify-content-between">
                        <a href="/admin/person/{{ $person->id }}/show">{{ $person->name }} - {{ $person->getOriginal('pivot_role') }}</a>
                        <a class="small" onclick="return confirm_action()" href="{{ route('admin.investorperson.remove', ['investor_id' => $investor->id, 'person_id' => $person->id]) }}">
                            <i class="la la-trash"></i> Remove
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('after_scripts')

    <script type="text/javascript" src="{{ asset('assets/typeahead.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap-tagsinput.css') }}"/>

    <style>
        .twitter-typeahead {
            width:  100%;
        }
    </style>

    <script>
        var $input = $('.findPerson');

        var people = <?php echo $people; ?>;

        var peopleSearch = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.whitespace,
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          local: people
        });

        $('.findPerson').typeahead({
          hint: true,
          highlight: true,
          minLength: 1
        },
        {
          name: 'peopleSearch',
          source: peopleSearch
        });

        function confirm_action() {
            return confirm('are you sure?');
        }
    </script>

@endsection
