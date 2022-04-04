<?php

namespace App\Http\Controllers\Enterprise;

use App\Http\Controllers\Controller;
use App\Models\Focus;
use App\Models\Job;
use App\Models\Patent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class DashboardChartsController extends Controller
{
    public function organizationsFocusChart(): string
    {
        $data = DB::table('company_focus')
            ->orderBy('name')
            ->select('focus.name', DB::raw('COUNT(company_focus.company_id) as total'))
            ->join('focus', 'focus.id', '=', 'company_focus.focus_id')
            ->where('focus.type', Focus::TYPE_DRUG)
            ->groupBy('company_focus.focus_id')
            ->get();

        $labels = $data->pluck('name')->toJson();
        $values = $data->pluck('total')->toJson();
        $colors = json_encode($this->getChartColors(count($data->pluck('total'))));

        return View::make("enterprise.widgets.chart-organizations-focus")->with([
            'labels' => $labels,
            'values' => $values,
            'colors' => $colors
        ])->render();
    }

    public function organizationsIndustryChart(): string
    {
        $data = DB::table('company_focus')
            ->orderBy('name')
            ->select('focus.name', DB::raw('COUNT(company_focus.company_id) as total'))
            ->join('focus', 'focus.id', '=', 'company_focus.focus_id')
            ->where('focus.type', '!=', Focus::TYPE_DRUG)
            ->orWhereNull('focus.type')
            ->groupBy('company_focus.focus_id')
            ->get();

        $labels = $data->pluck('name')->toJson();
        $values = $data->pluck('total')->toJson();
        $colors = json_encode($this->getChartColors(count($data->pluck('total'))));

        return View::make("enterprise.widgets.chart-organizations-industry")->with([
            'labels' => $labels,
            'values' => $values,
            'colors' => $colors
        ])->render();
    }

    public function jobDemandChart(): string
    {
        $jobsByMonth = Job::select(
            DB::raw('count(id) as `count`'),
            DB::raw("DATE_FORMAT(posted_date, '%Y-%m') as date"),
        )
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();

        $values = [];
        $labels = [];

        foreach ($jobsByMonth as $group) {
            array_push($values, $group['count']);
            array_push($labels, Carbon::parse($group['date'])->format('M Y'));
        }

        return View::make("enterprise.widgets.chart-job-demand")->with([
            'labels' => json_encode($labels),
            'values' => json_encode($values),
        ])->render();

    }

    public function activePatentsChart(): string
    {
        $activePatents = Patent::select(
            DB::raw('count(id) as `count`'),
            DB::raw("DATE_FORMAT(priority_date, '%Y') as date"),
        )
            ->whereIn('status', Patent::STATUSES_ACTIVE)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();

        $values = [];
        $labels = [];

        foreach ($activePatents as $group) {
            array_push($values, $group['count']);
            array_push($labels, $group['date']);
        }

        return View::make("enterprise.widgets.chart-active-patent-by-year")->with([
            'labels' => json_encode($labels),
            'values' => json_encode($values),
        ])->render();
    }

    public function clinicalTrialsChart(): string
    {
        $focuses = [
            'Psilocybin',
            'Ketamine',
            'MDMA',
            'GHB',
            'LSD'
        ];

        $statuses = [
            'activeNotRecruiting' => 'Active, not recruiting',
            'completed' => 'Completed',
            'enrollingByInvitation' => 'Enrolling by invitation',
            'notYetRecruiting' => 'Not yet recruiting',
            'recruiting' => 'Recruiting',
            'suspended' => 'Suspended',
            'temporarilyNotAvailable' => 'Temporarily not available',
            'terminated' => 'Terminated',
            'unknown' => 'Unknown status',
            'withdrawn' => 'Withdrawn',
        ];

        $focusesQuery = Focus::select(['name'])->whereIn('name', $focuses);

        foreach ($statuses as $label => $status) {
            $focusesQuery->withCount(['clinicaltrials as ' . $label => function (Builder $query) use ($status) {
                $query->where('status', $status);
            }]);
        }

        $focuses = $focusesQuery->get()->toArray();

        $values = [];

        foreach ($focuses as $focus) {
            $focusName = $focus['name'];
            unset($focus['name']);
            $values[$focusName] = array_values($focus);
        }

        $labels = array_values($statuses);

        return View::make("enterprise.widgets.chart-clinical-trials-status")->with([
            'labels' => json_encode($labels),
            'values' => json_encode($values),
        ])->render();

    }

    public function investmentByFocus(): string
    {
        $focus = Focus::drugs()->orderBy('name')->whereHas('companies', function(Builder $query) {
                $query->whereHas('investors');
            })
            ->withCount(['companies' => function(Builder $query) {
                $query->whereHas('investors');
            }])
            ->get()
            ->pluck('companies_count', 'name')
            ->toArray();

        $values = array_values($focus);
        $labels = array_keys($focus);
        $colors = $this->getChartColors(count($labels));

        return View::make("enterprise.widgets.chart-investment-by-focus")->with([
            'labels' => json_encode($labels),
            'values' => json_encode($values),
            'colors' => json_encode($colors),
        ])->render();
    }

    private function getChartColors($numberOfColors): array
    {
        $allColors = [
            '#3366CC',
            '#DC3912',
            '#FF9900',
            '#109618',
            '#990099',
            '#3B3EAC',
            '#0099C6',
            '#DD4477',
            '#66AA00',
            '#B82E2E',
            '#316395',
            '#994499',
            '#22AA99',
            '#AAAA11',
            '#6633CC',
            '#E67300',
            '#8B0707',
            '#329262',
            '#5574A6',
            '#3B3EAC',
        ];

        $colors = [];

        if (count($allColors) < $numberOfColors) {
            $multiplier = ceil($numberOfColors / count($allColors));

            $newColors = $allColors;

            for ($i = 0; $i < $multiplier; $i++) {
                $allColors = array_merge($allColors, $newColors);
            }
        }

        for ($i = 0; $i < $numberOfColors; $i++) {
            array_push($colors, $allColors[$i]);
        }

        return $colors;
    }
}
