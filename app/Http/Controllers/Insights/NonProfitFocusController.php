<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Focus;
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

        foreach ($focuses as $focus) {

            $nonprofits = $focus->companies;

            $focusData = [
                'name' => $focus->name,
                'value' => $focus->companies->count(),
                'image' => ''
            ];

            $children = [];

            foreach ($nonprofits as $nonprofit) {

                $locationString = implode(' / ', $nonprofit->locations->pluck('name')->toArray());
                $focusString = implode(' / ', $nonprofit->focus->pluck('name')->toArray());

                array_push($children, [
                    'name' => $nonprofit->name,
                    'image' => $nonprofit->entityImageUrl,
                    'value' => 1,
                    'url' => route('discover.organizations.show', $nonprofit->slug),
                    'location' => $locationString,
                    'focus' => $focusString,
                ]);

            }

            $focusData['children'] = $children;

            array_push($chartData, $focusData);

        }

        return $chartData;
    }
}
