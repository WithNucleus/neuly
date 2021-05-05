<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Models\Focus;

class NonProfitFocusController extends Controller
{
    /**
     * Shows the Non-Profit Focus Chart
     */
    public function chart() {

        $focusGroups = Focus::with(['companies' => function ($query) {
            $query->nonprofits()->withCount('jobs', 'events', 'clinicaltrials', 'people');
        }, 'companies.locations:name', 'companies.focus:name'])
            ->get();

        $chartData = json_encode($this->processFocusChildren($focusGroups));

        return view('discover.insights.nonprofits.focus-chart', compact('chartData'));
    }

    /**
     * Process each Focus's children for the chart
     * @param $focusGroups
     * @return array
     */
    private function processFocusChildren($focusGroups) {

        $chartData = [];
        $otherFocusData = [];

        foreach ($focusGroups as $focus) {

            $nonprofits = $focus->companies;

            $focusData = [
                'name' => $focus->name,
                'value' => $focus->companies->count(),
                'image' => asset('images/focus/' . $focus->slug . '.svg'),
                'type' => 'focus',
                'color' => '#A7ABDD'
            ];

            $children = [];

            foreach ($nonprofits as $nonprofit) {

                $locationString = implode(' / ', $nonprofit->locations->pluck('name')->toArray());
                $focusString = implode(' / ', $nonprofit->focus->pluck('name')->toArray());

                array_push($children, [
                    'name' => $nonprofit->name,
                    'image' => asset($nonprofit->entityImageUrl),
                    'value' => 1,
                    'url' => route('discover.organizations.show', $nonprofit->slug),
                    'insightUrl' => route('insights.investment-funds.organization', $nonprofit->slug),
                    'location' => $locationString,
                    'focus' => $focusString,
                    'type' => 'company',
                    'color' => '#fff',
                    'jobs' => $nonprofit->jobs_count,
                    'events' => $nonprofit->events_count,
                    'clinicalTrials' => $nonprofit->clinicaltrials_count,
                    'people' => $nonprofit->people_count,
                ]);

            }

            $focusData['children'] = $children;

            if ($focus->companies->count() >= 5) {
                array_push($chartData, $focusData);
            } else {
                array_push($otherFocusData, $focusData);
            }

        }

        $otherFocus = [
            'name' => 'Other',
            'value' => 4,
            'image' => asset('images/focus/other.svg'),
            'children' => $otherFocusData,
            'type' => 'focus',
            'color' => '#A7ABDD'
        ];

        array_push($chartData, $otherFocus);

        return $chartData;
    }
}
