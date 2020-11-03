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

                        <ul>
                            <li>
                                <a href="{{ route('import.related-entities.locations.index') }}"> Import Locations</a>
                            </li>
                            <li>
                                <a href="{{ route('import.related-entities.people-organization.index') }}"> Import People To Organisations</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
