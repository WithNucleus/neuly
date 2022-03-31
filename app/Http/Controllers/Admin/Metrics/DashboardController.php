<?php

namespace App\Http\Controllers\Admin\Metrics;

use App\Http\Controllers\Controller;
use App\Models\Metric;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {

        $allFields = Metric::CHART_FIELDS;
        $currentFields = $allFields;

        $removeSeries = explode(',', $request->input('remove'));

        foreach ($removeSeries as $series) {
            unset($currentFields[$series]);
        }

        unset($currentFields['media_items_total']);
        unset($allFields['media_items_total']);

        $selectFields = array_keys($currentFields);
        array_unshift($selectFields, 'date');

        $metricsQuery = Metric::counts()
            ->orderBy('date', 'asc')
            ->daily();

        // Date Stuff
        $dateRange = $request->input('range');

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
            'custom' => 'Custom'
        ];

        $startDate = match ($dateRange) {
            "this-week" => Carbon::now()->startOfWeek()->format('Y-m-d'),
            "today" => Carbon::now()->format('Y-m-d'),
            "last-week" => Carbon::now()->startOfWeek()->subWeeks(1)->format('Y-m-d'),
            "last-month" => Carbon::now()->subMonths(1)->startOfMonth()->format('Y-m-d'),
            "last-quarter" => Carbon::now()->startOfQuarter()->subQuarter()->format('Y-m-d'),
            "last-year" => Carbon::now()->startOfYear()->subYear()->format('Y-m-d'),
            "year-to-date" => Carbon::now()->startOfYear()->format('Y-m-d'),
            "quarter-to-date" => Carbon::now()->startOfQuarter()->format('Y-m-d'),
            "month-to-date" => Carbon::now()->startOfMonth()->format('Y-m-d'),
            default => Carbon::now()->subDays(30)->format('Y-m-d')
        };

        $endDate = match ($dateRange) {
            "this-week" => Carbon::now()->endOfWeek()->format('Y-m-d'),
            "last-week" => Carbon::now()->endOfWeek()->subWeeks(1)->format('Y-m-d'),
            "last-month" => Carbon::now()->subMonths(1)->endOfMonth()->format('Y-m-d'),
            "last-quarter" => Carbon::now()->endOfQuarter()->subQuarter()->format('Y-m-d'),
            "last-year" => Carbon::now()->endOfYear()->subYear()->format('Y-m-d'),
            default => Carbon::now()->format('Y-m-d')
        };

        $metrics = $metricsQuery
            ->whereBetween('date', [$startDate, $endDate])
            ->select($selectFields)
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
            'dateRange'
        ));
    }
}
