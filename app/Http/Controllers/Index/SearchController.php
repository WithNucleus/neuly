<?php

namespace App\Http\Controllers\Index;

use App\Models\Clinicaltrial;
use App\Models\Company;
use App\Models\Event;
use App\Models\Focus;
use App\Models\Investor;
use App\Models\Job;
use App\Models\Location;
use App\Models\Person;
use App\Models\Research;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * General search handler
     *
     * @param string $term
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(string $term)
    {
        $limit = 3;
        $searchTerm = $this->getSearchTerm($term);

        $organizations  = $this->getOrganizationsQuery($searchTerm)->limit($limit)->get();
        $people         = $this->getPeopleQuery($searchTerm)->limit($limit)->get();
        $investors      = $this->getInvestorsQuery($searchTerm)->limit($limit)->get();
        $research       = $this->getResearchQuery($searchTerm)->limit($limit)->get();
        $locations      = $this->getLocationsQuery($searchTerm)->limit($limit)->get();
        $focus          = $this->getFocusQuery($searchTerm)->limit($limit)->get();
        $events         = $this->getEventsQuery($searchTerm)->limit($limit)->get();
        $jobs           = $this->getJobsQuery($searchTerm)->limit($limit)->get();
        $clinicalTrials = $this->getClinicalTrialsQuery($searchTerm)->limit($limit)->get();

        //return view
        return view('search.index', compact(
            'organizations',
            'people',
            'investors',
            'research',
            'locations',
            'focus',
            'events',
            'jobs',
            'term',
            'clinicalTrials'
        ));
    }

    /**
     * Handler for POST request
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function search() {
        $searchTerm = $this->getSearchTerm();

        if (empty($searchTerm)) {
            return redirect()->back()->with('error', "Search term can't be empty!");
        }

        return redirect()->route('search.index', $searchTerm);
    }

    public function showOrganizationResults(string $term = null)
    {
        $searchTerm = $this->getSearchTerm($term);
        $organizations = $this->getOrganizationsQuery($searchTerm)->get();

        $data  = [
          'term' => $term,
          'type' => 'Organizations',
          'route' => 'discover.organizations.show',
          'result' => $organizations,
        ];

        return view('search.entity-result', $data);
    }

    public function showPeopleResults(string $term = null)
    {
        $searchTerm = $this->getSearchTerm($term);
        $people = $this->getPeopleQuery($searchTerm)->get();

        $data  = [
            'term' => $term,
            'type' => 'People',
            'route' => 'discover.people.show',
            'result' => $people,
        ];

        return view('search.entity-result', $data);
    }

    public function showInvestorResults(string $term = null)
    {
        $searchTerm = $this->getSearchTerm($term);
        $investors = $this->getInvestorsQuery($searchTerm)->get();

        $data  = [
            'term' => $term,
            'type' => 'Investors',
            'route' => 'discover.investors.show',
            'result' => $investors,
        ];

        return view('search.entity-result', $data);
    }

    public function showResearchResults(string $term = null)
    {
        $searchTerm = $this->getSearchTerm($term);
        $research = $this->getResearchQuery($searchTerm)->get();

        $data  = [
            'term' => $term,
            'type' => 'Research',
            'route' => 'discover.research.show',
            'result' => $research,
        ];

        return view('search.entity-result', $data);
    }

    public function showLocationResults(string $term = null)
    {
        $searchTerm = $this->getSearchTerm($term);
        $locations = $this->getLocationsQuery($searchTerm)->get();

        $data  = [
            'term' => $term,
            'type' => 'Locations',
            'route' => 'discover.locations.show',
            'result' => $locations,
        ];

        return view('search.entity-result', $data);
    }

    public function showFocusResults(string $term = null)
    {
        $searchTerm = $this->getSearchTerm($term);
        $focus = $this->getFocusQuery($searchTerm)->get();

        $data  = [
            'term' => $term,
            'type' => 'Focus',
            'route' => 'discover.focus.show',
            'result' => $focus,
        ];

        return view('search.entity-result', $data);
    }

    public function showEventResults(string $term = null)
    {
        $searchTerm = $this->getSearchTerm($term);
        $events = $this->getEventsQuery($searchTerm)->get();

        $data  = [
            'term' => $term,
            'type' => 'Events',
            'route' => 'discover.events.show',
            'result' => $events,
        ];

        return view('search.entity-result', $data);
    }

    public function showJobResults(string $term = null)
    {
        $searchTerm = $this->getSearchTerm($term);
        $jobs = $this->getJobsQuery($searchTerm)->get();

        $data  = [
            'term' => $term,
            'type' => 'Jobs',
            'route' => 'discover.jobs.show',
            'result' => $jobs,
        ];

        return view('search.entity-result', $data);
    }

    public function showClinicalTrialsResults(string $term = null)
    {
        $searchTerm = $this->getSearchTerm($term);
        $clinicalTrials = $this->getClinicalTrialsQuery($searchTerm)->get();

        $data  = [
            'term' => $term,
            'type' => 'Clinical Trials',
            'route' => 'discover.clinicaltrials.show',
            'result' => $clinicalTrials,
        ];

        return view('search.entity-result', $data);
    }

    /**
     * @param string|null $term
     * @return string
     */
    private function getSearchTerm(string $term = null) {
        return ($term !== null) ? $term : request()->input('search');
    }

    /**
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getOrganizationsQuery(string $term)
    {
        return Company::where('name', 'like', '%' . $term . '%');
    }

    /**
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getPeopleQuery(string $term)
    {
        return Person::where('name', 'like', '%' . $term . '%');
    }

    /**
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getInvestorsQuery(string $term)
    {
        return Investor::where('name', 'like', '%' . $term . '%');
    }

    /**
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getResearchQuery(string $term)
    {
        return Research::where('name', 'like', '%' . $term . '%');
    }

    /**
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getLocationsQuery(string $term)
    {
        return Location::where('name', 'like', '%' . $term . '%');
    }

    /**
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getFocusQuery(string $term)
    {
        return Focus::where('name', 'like', '%' . $term . '%')
            ->orWhere('aliases', 'like', '%' . $term . '%');
    }

    /**
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getEventsQuery(string $term)
    {
        return Event::where('name', 'like', '%' . $term . '%');
    }

    /**
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getJobsQuery(string $term)
    {
        return Job::where('job_title', 'like', '%' . $term . '%');
    }

    /**
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getClinicalTrialsQuery(string $term)
    {
        return Clinicaltrial::where('title', 'like', '%' . $term . '%');
    }
}
