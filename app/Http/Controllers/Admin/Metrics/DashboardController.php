<?php

namespace App\Http\Controllers\Admin\Metrics;

use App\Enum\MediaTypes;
use App\Http\Controllers\Controller;
use App\Models\MediaItem;
use App\Models\Metric;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function charts(Request $request) {

        $allFields = Metric::CHART_FIELDS;
        $currentFields = $allFields;

        unset($currentFields['media_items_total']);
        unset($allFields['media_items_total']);

        // Filters
        $removeSeries = explode(',', $request->input('remove'));

        $filterChartType = match($request->input('type')) {
            'bar' => 'bar',
            default => 'line'
        };

        $filterMetricsType = match($request->input('metrics')) {
            'changes' => 'changes',
            default => 'counts'
        };

        // Remove Series from Current Fields
        foreach ($removeSeries as $series) {
            unset($currentFields[$series]);
        }

        // Start Selected Fields
        $selectedFields = array_keys($currentFields);
        array_unshift($selectedFields, 'date');

        // Metrics Query
        $metricsQuery = Metric::{$filterMetricsType}()->orderBy('date', 'asc')->daily();

        // Date Stuff
        $filterDateRange = $request->input('range');
        $presetRanges = $this->getPresetDateRanges();
        $startDate = $this->matchStartDate($filterDateRange);
        $endDate = $this->matchEndDate($filterDateRange);

        $metrics = $metricsQuery
            ->whereBetween('date', [$startDate, $endDate])
            ->select($selectedFields)
            ->get();

        $stackedBarData = json_encode($metrics->toArray());
        $currentFieldsJson = json_encode($currentFields);

        return view('admin.metrics.charts.index', compact(
            'metrics',
            'stackedBarData',
            'allFields',
            'currentFields',
            'currentFieldsJson',
            'presetRanges',
            'filterDateRange',
            'filterChartType',
            'filterMetricsType',
            'startDate',
            'endDate'
        ));
    }

    public function tiles(Request $request) {

        $filterDateRange = $request->input('range') ?: 'this-week';
        $filterDateStart = $this->matchStartDate($filterDateRange);
        $filterDateEnd = $this->matchEndDate($filterDateRange);

        if ($request->input('start')) {
            $filterDateStart = Carbon::parse($request->input('start'))->startOfDay();
            $filterDateRange = 'custom';
        }

        if ($request->input('end')) {
            $filterDateEnd = Carbon::parse($request->input('end'))->endOfDay();
        }

        $presetRanges = $this->getPresetDateRanges();
        $entityTables = Metric::TILE_TABLES;
        $tileLabels = Metric::TILE_LABELS;

        $metrics = [];
        $totalRecords = 0;

        foreach ($tileLabels as $key => $value) {
            $metrics[$key] = [
                'label' => $value,
                'count' => 0
            ];
        }

        foreach ($entityTables as $table) {
            $count = DB::table($table)
                ->whereBetween('created_at', [$filterDateStart, $filterDateEnd])
                ->count();
            $totalRecords += $count;
            $metrics[$table]['count'] = $count;
        }

        $mediaMetrics = DB::table('media_items')
            ->whereBetween('created_at', [$filterDateStart, $filterDateEnd])
            ->where('status', MediaItem::STATUS_PUBLIC)
            ->get()
            ->groupBy('media_type')
            ->toArray();

        foreach ($mediaMetrics as $label => $data) {
            $count = count($data);
            $totalRecords += $count;
            $metrics[$label]['count'] = $count;
        }

        $chartData = json_encode(array_values($metrics));

        return view('admin.metrics.tiles.index', compact(
            'filterDateStart',
            'filterDateEnd',
            'metrics',
            'chartData',
            'totalRecords',
            'mediaMetrics',
            'presetRanges',
            'filterDateRange'
        ));

    }

    public function tileDetails(Request $request) {
        $entity = $request->input('entity');

        $filterDateStart = Carbon::parse($request->input('start'))->startOfDay();
        $filterDateEnd = Carbon::parse($request->input('end'))->endOfDay();

        $mediaItems = MediaTypes::MEDIA_TYPES;

        if (in_array($entity, $mediaItems)) {
            $metrics = DB::table('media_items')
                ->where('media_type', $entity)
                ->whereBetween('created_at', [$filterDateStart, $filterDateEnd])
                ->orderBy('created_at')
                ->get()
                ->toArray();
        } else {
            $metrics = DB::table($entity)
                ->whereBetween('created_at', [$filterDateStart, $filterDateEnd])
                ->orderBy('created_at')
                ->get()
                ->toArray();
        }

        $tileLabels = Metric::TILE_LABELS;

        $entityLabel = $tileLabels[$entity];

        return view('admin.metrics.tiles.tile-details', compact(
            'filterDateStart',
            'filterDateEnd',
            'metrics',
            'entity',
            'entityLabel',
        ));
    }

    private function getPresetDateRanges(): array
    {
        return [
            'last-30-days' => 'Last 30 Days',
            'year-to-date' => 'Year to Date',
            'quarter-to-date' => 'Quarter to Date',
            'month-to-date' => 'Month to Date',
            'this-week' => 'This Week',
            'today' => 'Today',
            'last-week' => 'Last Week',
            'last-month' => 'Last Month',
            'last-quarter' => 'Last Quarter',
            'last-year' => 'Last Year',
            'all-time' => 'All Time',
            'custom' => 'Custom'
        ];
    }

    private function matchStartDate($filterDateRange): string
    {
        return match ($filterDateRange) {
            "this-week" => Carbon::now()->startOfWeek()->startOfDay()->format('Y-m-d H:i:s'),
            "today" => Carbon::now()->startOfDay()->format('Y-m-d H:i:s'),
            "last-week" => Carbon::now()->startOfWeek()->subWeeks(1)->startOfDay()->format('Y-m-d H:i:s'),
            "last-month" => Carbon::now()->subMonths(1)->startOfMonth()->startOfDay()->format('Y-m-d H:i:s'),
            "last-quarter" => Carbon::now()->startOfQuarter()->subQuarter()->startOfDay()->format('Y-m-d H:i:s'),
            "last-year" => Carbon::now()->startOfYear()->subYear()->startOfDay()->format('Y-m-d H:i:s'),
            "year-to-date" => Carbon::now()->startOfYear()->startOfDay()->format('Y-m-d H:i:s'),
            "quarter-to-date" => Carbon::now()->startOfQuarter()->startOfDay()->format('Y-m-d H:i:s'),
            "month-to-date" => Carbon::now()->startOfMonth()->startOfDay()->format('Y-m-d H:i:s'),
            "all-time" => '2020-06-01',
            default => Carbon::now()->subDays(30)->startOfDay()->format('Y-m-d H:i:s')
        };
    }

    private function matchEndDate($filterDateRange): string
    {
        return match ($filterDateRange) {
            "this-week" => Carbon::now()->endOfWeek()->endOfDay()->format('Y-m-d H:i:s'),
            "last-week" => Carbon::now()->endOfWeek()->subWeeks(1)->endOfDay()->format('Y-m-d H:i:s'),
            "last-month" => Carbon::now()->subMonths(1)->endOfMonth()->endOfDay()->format('Y-m-d H:i:s'),
            "last-quarter" => Carbon::now()->endOfQuarter()->subQuarter()->endOfDay()->format('Y-m-d H:i:s'),
            "last-year" => Carbon::now()->endOfYear()->subYear()->endOfDay()->format('Y-m-d H:i:s'),
            default => Carbon::now()->endOfDay()->format('Y-m-d H:i:s')
        };
    }
}
