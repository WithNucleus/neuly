<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Focus;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

class NonProfitFocusController extends Controller
{
    public function chart() {

        $focuses = Focus::with(['companies' => function ($query) {
            $query->nonprofits();
        }, 'companies.locations:name', 'companies.focus:name'])
            ->get();

        $chartData = json_encode($this->processFocusChildren($focuses));

        return view('discover.insights.nonprofits.focus-chart', compact('chartData'));
    }

    private function processFocusChildren($focuses) {

        $chartData = [];
        $otherFocusData = [];

        foreach ($focuses as $focus) {

            $nonprofits = $focus->companies;

            $focusData = [
                'name' => $focus->name,
                'value' => $focus->companies->count(),
                'image' => asset('images/focus/' . $focus->slug . '.svg'),
                'type' => 'focus'
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
                    'location' => $locationString,
                    'focus' => $focusString,
                    'type' => 'company'
                ]);

            }

            $focusData['children'] = $children;

//            array_push($chartData, $focusData);

            if ($focus->companies->count() >= 5) {
                array_push($chartData, $focusData);
            } else {
                array_push($otherFocusData, $focusData);
            }

        }

        // Add Other Focus Groups
        $otherFocus = [
            'name' => 'Other',
            'value' => 4,
            'image' => asset('images/focus/other.svg'),
            'children' => $otherFocusData,
            'type' => 'focus'
        ];

        array_push($chartData, $otherFocus);

        return $chartData;
    }
}
