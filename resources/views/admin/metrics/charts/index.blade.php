@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Metrics Dashboard - {{ $filterMetricsType }}</span>
        </h2>
    </div>
@endsection

@section('content')
    <div class="row mt-4">

        @include('admin.metrics.charts._controls')

        <div class="col-12">

            <div id="chart" data-stackedBar-values="{{ $stackedBarData }}" data-chart-series="{{ $currentFieldsJson }}"></div>

            <table class="table mt-5">
                <thead>
                <tr>
                    <th>Date</th>
                    @foreach($currentFields as $fieldName => $fieldLabel)
                        <th>{{ $fieldLabel }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @forelse ($metrics as $metric)
                    <tr>
                        <td>
                            {{ \Carbon\Carbon::parse($metric->date)->format('Y-m-d') }}
                        </td>
                        @foreach($currentFields as $fieldName => $fieldLabel)
                            <td>{{ $metric->{$fieldName} }}</td>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            No records match your query
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('after_scripts')
    <style>
        #chart {
            width: 100%;
            height: 1000px;
        }
    </style>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Kelly.js"></script>
    <script src="{{ asset('js/' . $filterChartType . '.js') }}"></script>
@endsection
