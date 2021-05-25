<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Models\Company;

class EducationalOrganizationsMapController extends Controller
{
    public function map() {

        $educationalOrganizations = Company::educational()
            ->whereHas('locations')
            ->with(['locations', 'focus', 'investors', 'clinicaltrials'])
            ->withCount(['locations', 'clinicaltrials', 'jobs', 'events', 'people'])
            ->get();

        $chartData = json_encode($this->processChartData($educationalOrganizations), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);

        return view('discover.insights.educational-organizations.map', compact('chartData'));

    }

    private function processChartData($educationalOrganizations) {

        $chartData = [];

        foreach ($educationalOrganizations as $organization) {

            $firstLocation = $organization->locations->first();

            $focusString = implode(' / ', $organization->focus->pluck('name')->toArray());

            $organizationData = [
                'name' => $organization->name,
                'url' => route('discover.organizations.show', $organization->slug),
                'insightUrl' => route('insights.investment-funds.organization', $organization->slug),
                'image' => url($organization->EntityImageUrl),
                'value' => 1,
                'focus' => $focusString,
                'clinicalTrialsCount' => $organization->clinicaltrials_count,
                'jobsCount' => $organization->jobs_count,
                'peopleCount' => $organization->people_count,
                'eventsCount' => $organization->events_count,
                'longitude' => $firstLocation->longitude,
                'latitude' => $firstLocation->latitude,
                'location' => $firstLocation->name,
            ];

            array_push($chartData, $organizationData);

        }

        return $chartData;
    }
}
