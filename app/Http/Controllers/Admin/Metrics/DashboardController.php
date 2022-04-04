<?php

namespace App\Http\Controllers\Admin\Metrics;

use App\Enum\MediaTypes;
use App\Http\Controllers\Controller;
use App\Models\Clinicaltrial;
use App\Models\Company;
use App\Models\Course;
use App\Models\Event;
use App\Models\Investor;
use App\Models\Job;
use App\Models\Location;
use App\Models\MediaItem;
use App\Models\Metric;
use App\Models\Patent;
use App\Models\Person;
use App\Models\Research;
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

        $presetRanges = [
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
        ];

        $startDate = match ($filterDateRange) {
            "this-week" => Carbon::now()->startOfWeek()->format('Y-m-d'),
            "today" => Carbon::now()->format('Y-m-d'),
            "last-week" => Carbon::now()->startOfWeek()->subWeeks(1)->format('Y-m-d'),
            "last-month" => Carbon::now()->subMonths(1)->startOfMonth()->format('Y-m-d'),
            "last-quarter" => Carbon::now()->startOfQuarter()->subQuarter()->format('Y-m-d'),
            "last-year" => Carbon::now()->startOfYear()->subYear()->format('Y-m-d'),
            "year-to-date" => Carbon::now()->startOfYear()->format('Y-m-d'),
            "quarter-to-date" => Carbon::now()->startOfQuarter()->format('Y-m-d'),
            "month-to-date" => Carbon::now()->startOfMonth()->format('Y-m-d'),
            "all-time" => '2020-07-01',
            default => Carbon::now()->subDays(30)->format('Y-m-d')
        };

        $endDate = match ($filterDateRange) {
            "this-week" => Carbon::now()->endOfWeek()->format('Y-m-d'),
            "last-week" => Carbon::now()->endOfWeek()->subWeeks(1)->format('Y-m-d'),
            "last-month" => Carbon::now()->subMonths(1)->endOfMonth()->format('Y-m-d'),
            "last-quarter" => Carbon::now()->endOfQuarter()->subQuarter()->format('Y-m-d'),
            "last-year" => Carbon::now()->endOfYear()->subYear()->format('Y-m-d'),
            default => Carbon::now()->format('Y-m-d')
        };

        $metrics = $metricsQuery
            ->whereBetween('date', [$startDate, $endDate])
            ->select($selectedFields)
            ->get();

        $stackedBarData = json_encode($metrics->toArray());
        $currentFieldsJson = json_encode($currentFields);

        return view('admin.metrics.dashboard', compact(
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

        $filterDateStart = Carbon::parse($request->input('start'))->startOfDay();
        $filterDateEnd = Carbon::parse($request->input('end'))->endOfDay();

        $entityTables = Metric::TILE_TABLES;
        $tileLabels = Metric::TILE_LABELS;

        $metrics = [];

        foreach ($entityTables as $table) {
            $metrics[$table] = DB::table($table)
                ->whereBetween('created_at', [$filterDateStart, $filterDateEnd])
                ->get()
                ->toArray();
        }

        $mediaMetrics = DB::table('media_items')
            ->whereBetween('created_at', [$filterDateStart, $filterDateEnd])
            ->get()
            ->groupBy('media_type')
            ->toArray();

        return view('admin.metrics.tiles.index', compact(
            'filterDateStart',
            'filterDateEnd',
            'metrics',
            'tileLabels',
            'mediaMetrics'
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
                ->get()
                ->toArray();
        } else {
            $metrics = DB::table($entity)
                ->whereBetween('created_at', [$filterDateStart, $filterDateEnd])
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
}
