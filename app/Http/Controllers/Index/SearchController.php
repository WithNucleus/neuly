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
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $limit = 3;

    /**
     * General search handler
     *
     * @param string $term
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(string $term)
    {
        $searchTerm = '%' . $term . '%';

        $organizations  = $this->searchOrganizations($searchTerm, true);
        $people         = $this->searchPeople($searchTerm, true);
        $investors      = $this->searchInvestors($searchTerm, true);
        $research       = $this->searchResarch($searchTerm, true);
        $locations      = $this->searchLocations($searchTerm, true);
        $focus          = $this->searchFocus($searchTerm, true);
        $events         = $this->searchEvents($searchTerm, true);
        $jobs           = $this->searchJobs($searchTerm, true);
        $clinicalTrials = $this->searchClinicalTrials($searchTerm, true);

        //return view
        return view('search.index', compact('organizations', 'people', 'investors', 'research', 'locations', 'focus', 'events', 'jobs', 'term', 'clinicalTrials'));
    }

    /**
     * Handler for POST request
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function search(Request $request) {
        $term = $request->input('search');

        if (empty($term)) {
            return redirect()->back()->with('error', "Search term can't be empty!");
        }

        return redirect()->route('search.term', $term);
    }

    public function showOrganizationResults(Request $request, string $term = null)
    {
        if($term === null)
        {
            $term = $request->input('search');
        }

        $searchTerm = '%' . $term . '%';

        $organizations = $this->searchOrganizations($searchTerm);

        $data  = [
          'term' => $term,
          'type' => 'Organizations',
          'route' => 'discover.organizations.show',
          'result' => $organizations,
        ];

        return view('search.entity-result', $data);
    }

    public function showPeopleResults(Request $request, string $term = null)
    {
        if($term === null)
        {
            $term = $request->input('search');
        }

        $searchTerm = '%' . $term . '%';

        $people = $this->searchPeople($searchTerm);

        $data  = [
            'term' => $term,
            'type' => 'People',
            'route' => 'discover.people.show',
            'result' => $people,
        ];

        return view('search.entity-result', $data);
    }

    public function showInvestorResults(Request $request, string $term = null)
    {
        if($term === null)
        {
            $term = $request->input('search');
        }

        $searchTerm = '%' . $term . '%';

        $investors = $this->searchInvestors($searchTerm);

        $data  = [
            'term' => $term,
            'type' => 'Investors',
            'route' => 'discover.investors.show',
            'result' => $investors,
        ];

        return view('search.entity-result', $data);
    }

    public function showResearchResults(Request $request, string $term = null)
    {
        if($term === null)
        {
            $term = $request->input('search');
        }

        $searchTerm = '%' . $term . '%';

        $research = $this->searchResarch($searchTerm);

        $data  = [
            'term' => $term,
            'type' => 'Research',
            'route' => 'discover.research.show',
            'result' => $research,
        ];

        return view('search.entity-result', $data);
    }

    public function showLocationResults(Request $request, string $term = null)
    {
        if($term === null)
        {
            $term = $request->input('search');
        }

        $searchTerm = '%' . $term . '%';

        $locations = $this->searchLocations($searchTerm);

        $data  = [
            'term' => $term,
            'type' => 'Locations',
            'route' => 'discover.locations.show',
            'result' => $locations,
        ];

        return view('search.entity-result', $data);
    }

    public function showFocusResults(Request $request, string $term = null)
    {
        if($term === null)
        {
            $term = $request->input('search');
        }

        $searchTerm = '%' . $term . '%';

        $focus = $this->searchFocus($searchTerm);

        $data  = [
            'term' => $term,
            'type' => 'Focus',
            'route' => 'discover.focus.show',
            'result' => $focus,
        ];

        return view('search.entity-result', $data);
    }

    public function showEventResults(Request $request, string $term = null)
    {
        if($term === null)
        {
            $term = $request->input('search');
        }

        $searchTerm = '%' . $term . '%';

        $events = $this->searchEvents($searchTerm);

        $data  = [
            'term' => $term,
            'type' => 'Events',
            'route' => 'discover.events.show',
            'result' => $events,
        ];

        return view('search.entity-result', $data);
    }

    public function showJobResults(Request $request, string $term = null)
    {
        if($term === null)
        {
            $term = $request->input('search');
        }

        $searchTerm = '%' . $term . '%';

        $jobs = $this->searchJobs($searchTerm);

        $data  = [
            'term' => $term,
            'type' => 'Jobs',
            'route' => 'discover.jobs.show',
            'result' => $jobs,
        ];

        return view('search.entity-result', $data);
    }

    public function showClinicalTrialsResults(Request $request, string $term = null)
    {
        if($term === null)
        {
            $term = $request->input('search');
        }

        $searchTerm = '%' . $term . '%';

        $clinicalTrials = $this->searchClinicalTrials($searchTerm);

        $data  = [
            'term' => $term,
            'type' => 'Clinical Trials',
            'route' => 'discover.clinicaltrials.show',
            'result' => $clinicalTrials,
        ];

        return view('search.entity-result', $data);
    }

    private function searchOrganizations(string $term, bool $limitResults = false)
    {
        $searchQuery = Company::where('name', 'like', $term);

        if($limitResults)
        {
            $searchQuery = $this->limitQueryResult($searchQuery);
        }

        return $searchQuery->get();
    }

    private function searchPeople(string $term, bool $limitResults = false)
    {
        $searchQuery = Person::where('name', 'like', $term);

        if($limitResults)
        {
            $searchQuery = $this->limitQueryResult($searchQuery);
        }

        return $searchQuery->get();
    }

    private function searchInvestors(string $term, bool $limitResults = false)
    {
        $searchQuery = Investor::where('name', 'like', $term);

        if($limitResults)
        {
            $searchQuery = $this->limitQueryResult($searchQuery);
        }

        return $searchQuery->get();
    }

    private function searchResarch(string $term, bool $limitResults = false)
    {
        $searchQuery = Research::where('name', 'like', $term);

        if($limitResults)
        {
            $searchQuery = $this->limitQueryResult($searchQuery);
        }

        return $searchQuery->get();
    }

    private function searchLocations(string $term, bool $limitResults = false)
    {
        $searchQuery = Location::where('name', 'like', $term);

        if($limitResults)
        {
            $searchQuery = $this->limitQueryResult($searchQuery);
        }

        return $searchQuery->get();
    }

    private function searchFocus(string $term, bool $limitResults = false)
    {
        $searchQuery = Focus::where('name', 'like', $term)->orWhere('aliases', 'like', $term);

        if($limitResults)
        {
            $searchQuery = $this->limitQueryResult($searchQuery);
        }

        return $searchQuery->get();
    }

    private function searchEvents(string $term, bool $limitResults = false)
    {
        $searchQuery = Event::where('name', 'like', $term);

        if($limitResults)
        {
            $searchQuery = $this->limitQueryResult($searchQuery);
        }

        return $searchQuery->get();
    }

    private function searchJobs(string $term, bool $limitResults = false)
    {
        $searchQuery = Job::where('job_title', 'like', $term);

        if($limitResults)
        {
            $searchQuery = $this->limitQueryResult($searchQuery);
        }

        return $searchQuery->get();
    }

    private function searchClinicalTrials(string $term, bool $limitResults = false)
    {
        $searchQuery = Clinicaltrial::where('title', 'like', $term);

        if($limitResults)
        {
            $searchQuery = $this->limitQueryResult($searchQuery);
        }

        return $searchQuery->get();
    }

    private function limitQueryResult($query)
    {
        return $query->limit($this->limit);
    }
}
