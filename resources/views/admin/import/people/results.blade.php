@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Import People Results</span>
        </h2>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-8 col-md-6">
            <div class="card card-body">
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Type</th>
                    </thead>
                    <tbody>
                    @foreach ($results as $result)
                        <tr>
                            <td>
                                @if($result['slug'] != '')
                                    <a href="{{ route('discover.people.show', $result['slug']) }}">{{ $result['name'] }}</a>
                                @else
                                    {{ $result['name'] }}
                                @endif
                            </td>
                            <td>{{ $result['status'] }}</td>
                            <td>{{ $result['type'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
