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
        <div class="col-12 col-md-8">
            <div class="card card-body">
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Status</th>
                        <th>Info</th>
                        <th>Link</th>
                        <th width="50%">Row data</th>
                    </thead>
                    <tbody>
                    @foreach ($results as $i => $result)
                        <tr class="{{ $result['status'] == 'Success' ? ($result['type'] == 'Create' ? 'text-success' : '') : 'text-error' }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $result['status'] }}</td>
                            <td>{{ $result['status'] == 'Success' ? $result['type'] : $result['error'] }}</td>
                            <td>
                                @if($result['slug'])
                                    <a class="btn btn-link" href="{{ route('discover.people.show', $result['slug']) }}" target="_blank">
                                        {{ $result['name'] }}
                                    </a>
                                @endif
                            </td>
                            <td width="50%">
                                <button class="btn btn-default" data-toggle="collapse" href="#collapse{{$i}}" role="button" aria-expanded="false" aria-controls="collapse{{$i}}">
                                    Expand
                                </button>
                                <div class="collapse text-dark" id="collapse{{$i}}">
                                    <table class="table-sm">
                                        <tbody>
                                            @foreach ($result['record'] as $key => $value)
                                            <tr>
                                                <td><b>{!! $key !!}</b></td>
                                                <td>{!! $value !!}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
