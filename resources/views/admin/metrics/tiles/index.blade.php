@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Neuly Records
            <small id="datatable_info_stack" class="animated fadeIn" style="display: inline-flex;">
                {{ Carbon\Carbon::parse($filterDateStart)->format('M d, Y') }} - {{ Carbon\Carbon::parse($filterDateEnd)->format('M d, Y') }}</span>
            </small>
        </h2>
    </div>
@endsection

@section('content')
    <div class="row mt-4">

        @foreach ($metrics as $entityLabel => $entityGroup)
            @include('admin.metrics.tiles.tile-template')
        @endforeach

        @foreach ($mediaMetrics as $entityLabel => $entityGroup)
            @include('admin.metrics.tiles.tile-template')
        @endforeach

    </div>
@endsection

@section('after_scripts')
    <style>
        [data-toggle="collapse"]:hover {
            cursor: pointer;
        }
        [data-toggle="collapse"][aria-expanded="true"] i {
            transform: rotate(180deg);
        }
    </style>
@endsection
