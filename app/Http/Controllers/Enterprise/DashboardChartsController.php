<?php

namespace App\Http\Controllers\Enterprise;

use App\Http\Controllers\Controller;
use App\Models\Clinicaltrial;
use App\Models\ClinicaltrialPhase;
use App\Models\Focus;
use App\Models\Job;
use App\Models\Patent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
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
            $focusesQuery->withCount([
                'clinicaltrials as ' . $label => function (Builder $query) use ($status) {
                    $query->where('status', $status);
                }
            ]);
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
        $focus = Focus::drugs()->orderBy('name')->whereHas('companies', function (Builder $query) {
            $query->whereHas('investors');
        })
            ->withCount([
                'companies' => function (Builder $query) {
                    $query->whereHas('investors');
                }
            ])
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

    public function clinicalTrialsFocusChart(Request $request): string
    {
        $phases = [];

        foreach (ClinicaltrialPhase::getPhases() as $phase) {
            $phases[$phase['integer']] = $phase['name'];
        }

        //get by all available phases by default
        $filteredPhases = array_keys($phases);
        $filter = $request->input('filter');

        if (isset($filter['phases'])) {
            $filteredPhases = explode('|', $filter['phases']);
        }

        $query = Focus::select(['name'])->where('focus.type', Focus::TYPE_DRUG);

        foreach ($filteredPhases as $value) {
            $query->withCount([
                'clinicaltrials as phase' . $value => function (Builder $query) use ($value) {
                    $query->where('phase_integer', $value);
                }
            ]);
        }

        $data = $query->get()->toArray();

        $values = [];
        $labels = [];

        foreach ($data as $item) {
            $focusName = $item['name'];
            unset($item['name']);
            $values[$focusName] = array_values($item);
        }

        foreach ($filteredPhases as $phaseInteger) {
            $labels[] = $phases[$phaseInteger];
        }

        $colors = $this->getChartColors(count($values));

        return View::make("enterprise.widgets.chart-clinical-trials-focus")->with([
            'labels' => json_encode($labels),
            'values' => json_encode($values),
            'colors' => json_encode($colors),
            'phases' => $phases,
            'filteredPhases' => $filteredPhases,
        ])->render();
    }

    public function clinicalTrialsLocationsMap()
    {
        $clinicalTrials = Clinicaltrial::active()
            ->with(['locations', 'focus'])
            ->whereHas('locations')
            ->get();

        $chartData = [];
        $availableFocuses = [];

        foreach ($clinicalTrials as $clinicalTrial) {
            $firstLocation = $clinicalTrial->locations->first();
            $focus = 'N/A';

            if (!empty($clinicalTrial->focus)) {
                if ($clinicalTrial->focus->count() > 1) {
                    $focus = 'Multiple';
                } else {
                    $focus = $clinicalTrial->focus->first()->name;
                }
            }

            if ($focus !== null && array_search($focus, $availableFocuses) === false) {
                array_push($availableFocuses, $focus);
            }

            $clinicalTrialData = [
                'title' => $clinicalTrial->title,
                'start_date' => date('M d, Y', strtotime($clinicalTrial->start_date)),
                'completion_date' => date('M d, Y', strtotime($clinicalTrial->completion_date)),
                'gender' => $clinicalTrial->gender,
                'min_age' => $clinicalTrial->min_age ?? 'n/a',
                'max_age' => $clinicalTrial->max_age ?? 'n/a',
                'url' => route('discover.clinicaltrials.show', $clinicalTrial->slug),
                'longitude' => $firstLocation->longitude,
                'latitude' => $firstLocation->latitude,
                'location' => $firstLocation->name,
                'focus' => $focus,
            ];

            array_push($chartData, $clinicalTrialData);
        }

        $colorsLegend = [];
        $colorsMapped = [];
        $colors = $this->getChartColors(count($availableFocuses));

        foreach ($availableFocuses as $index => $focusName) {
            $colorsMapped[$focusName] = $colors[$index];
            $colorsLegend[] = [
                'name' => $focusName,
                'fill' => $colors[$index]
            ];
        }

        foreach ($chartData as $key => $chartItem) {
            if ($chartItem['focus'] !== null) {
                $chartData[$key]['color'] = $colorsMapped[$chartItem['focus']];
            }
        }

        return View::make("enterprise.widgets.chart-clinical-trials-locations")->with([
            'chartData' => json_encode($chartData, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK),
            'availableFocuses' => json_encode($availableFocuses),
            'colorsLegend' => json_encode($colorsLegend),
        ])->render();
    }
}
