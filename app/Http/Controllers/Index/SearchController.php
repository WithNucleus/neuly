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
use App\Models\SearchLog;
use Illuminate\Database\Eloquent\Collection;

class SearchController extends Controller
{
    /**
     * General search handler
     *
     * @param string|null $term
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($term = null)
    {
        $limit        = 10;
        $results      = [];
        $exactResults = [];
        $searchTerm   = $this->getSearchTerm($term);

        if ($searchTerm === null) {
            abort(404);
        }

        $this->logSearchTerm($searchTerm);

        $exactResults['organizations']  = $this->getExactOrganizationsQuery($searchTerm)->get();
        $exactResults['people']         = $this->getExactPeopleQuery($searchTerm)->get();
        $exactResults['investors']      = $this->getExactInvestorsQuery($searchTerm)->get();
        $exactResults['research']       = $this->getExactResearchQuery($searchTerm)->get();
        $exactResults['locations']      = $this->getExactLocationsQuery($searchTerm)->get();
        $exactResults['focus']          = $this->getExactFocusQuery($searchTerm)->get();
        $exactResults['events']         = $this->getExactEventsQuery($searchTerm)->get();
        $exactResults['jobs']           = $this->getExactJobsQuery($searchTerm)->get();
        $exactResults['clinicalTrials'] = $this->getExactClinicalTrialsQuery($searchTerm)->get();

        $exactResults = $this->filterAndSortResults($exactResults);

        $results['organizations']  = $this->getOrganizationsQuery($searchTerm)->limit($limit)->get();
        $results['people']         = $this->getPeopleQuery($searchTerm)->limit($limit)->get();
        $results['investors']      = $this->getInvestorsQuery($searchTerm)->limit($limit)->get();
        $results['research']       = $this->getResearchQuery($searchTerm)->limit($limit)->get();
        $results['locations']      = $this->getLocationsQuery($searchTerm)->limit($limit)->get();
        $results['focus']          = $this->getFocusQuery($searchTerm)->limit($limit)->get();
        $results['events']         = $this->getEventsQuery($searchTerm)->limit($limit)->get();
        $results['jobs']           = $this->getJobsQuery($searchTerm)->limit($limit)->get();
        $results['clinicalTrials'] = $this->getClinicalTrialsQuery($searchTerm)->limit($limit)->get();

        $results = $this->filterAndSortResults($results);

        return view('search.index', compact(
            'term',
            'exactResults',
            'results'
        ));
    }

    /**
     * Handler for POST request
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function search()
    {
        $searchTerm = $this->getSearchTerm();

        if (empty($searchTerm)) {
            return redirect()->back()->with('error', "Search term can't be empty!");
        }

        return redirect()->route('search.index', $searchTerm);
    }

    public function showOrganizationResults(string $term = null)
    {
        $searchTerm    = $this->getSearchTerm($term);
        $organizations = $this->getOrganizationsQuery($searchTerm)->get();

        $data = [
            'term'   => $term,
            'type'   => 'Organizations',
            'route'  => 'discover.organizations.show',
            'result' => $organizations,
        ];

        return view('search.entity-result', $data);
    }

    public function showPeopleResults(string $term = null)
    {
        $searchTerm = $this->getSearchTerm($term);
        $people     = $this->getPeopleQuery($searchTerm)->get();

        $data = [
            'term'   => $term,
            'type'   => 'People',
            'route'  => 'discover.people.show',
            'result' => $people,
        ];

        return view('search.entity-result', $data);
    }

    public function showInvestorResults(string $term = null)
    {
        $searchTerm = $this->getSearchTerm($term);
        $investors  = $this->getInvestorsQuery($searchTerm)->get();

        $data = [
            'term'   => $term,
            'type'   => 'Investors',
            'route'  => 'discover.investors.show',
            'result' => $investors,
        ];

        return view('search.entity-result', $data);
    }

    public function showResearchResults(string $term = null)
    {
        $searchTerm = $this->getSearchTerm($term);
        $research   = $this->getResearchQuery($searchTerm)->get();

        $data = [
            'term'   => $term,
            'type'   => 'Research',
            'route'  => 'discover.research.show',
            'result' => $research,
        ];

        return view('search.entity-result', $data);
    }

    public function showLocationResults(string $term = null)
    {
        $searchTerm = $this->getSearchTerm($term);
        $locations  = $this->getLocationsQuery($searchTerm)->get();

        $data = [
            'term'   => $term,
            'type'   => 'Locations',
            'route'  => 'discover.locations.show',
            'result' => $locations,
        ];

        return view('search.entity-result', $data);
    }

    public function showFocusResults(string $term = null)
    {
        $searchTerm = $this->getSearchTerm($term);
        $focus      = $this->getFocusQuery($searchTerm)->get();

        $data = [
            'term'   => $term,
            'type'   => 'Focus',
            'route'  => 'discover.focus.show',
            'result' => $focus,
        ];

        return view('search.entity-result', $data);
    }

    public function showEventResults(string $term = null)
    {
        $searchTerm = $this->getSearchTerm($term);
        $events     = $this->getEventsQuery($searchTerm)->get();

        $data = [
            'term'   => $term,
            'type'   => 'Events',
            'route'  => 'discover.events.show',
            'result' => $events,
        ];

        return view('search.entity-result', $data);
    }

    public function showJobResults(string $term = null)
    {
        $searchTerm = $this->getSearchTerm($term);
        $jobs       = $this->getJobsQuery($searchTerm)->get();

        $data = [
            'term'   => $term,
            'type'   => 'Jobs',
            'route'  => 'discover.jobs.show',
            'result' => $jobs,
        ];

        return view('search.entity-result', $data);
    }

    public function showClinicalTrialsResults(string $term = null)
    {
        $searchTerm     = $this->getSearchTerm($term);
        $clinicalTrials = $this->getClinicalTrialsQuery($searchTerm)->get();

        $data = [
            'term'   => $term,
            'type'   => 'Clinical Trials',
            'route'  => 'discover.clinicaltrials.show',
            'result' => $clinicalTrials,
        ];

        return view('search.entity-result', $data);
    }

    /**
     * @param string|null $term
     * @return string
     */
    private function getSearchTerm(string $term = null)
    {
        return ($term !== null) ? $term : request()->input('search');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Collection[] $results
     * @return array
     */
    private function filterAndSortResults(array $results)
    {
        $results = array_filter($results, function (Collection $entityResults) {
            return $entityResults->count() > 0;
        });

        uasort($results, function (Collection $entityResults, Collection $comparingEntityResults) {
            if ($entityResults->count() == $comparingEntityResults->count()) {
                return 0;
            }

            return ($entityResults->count() > $comparingEntityResults->count()) ? -1 : 1;
        });

        return $results;
    }

    /**
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getOrganizationsQuery(string $term)
    {
        return Company::public()->where('name', 'like', '%' . $term . '%');
    }

    /**
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getExactOrganizationsQuery(string $term)
    {
        return Company::public()->where('name', $term);
    }

    /**
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getPeopleQuery(string $term)
    {
        return Person::public()->where('name', 'like', '%' . $term . '%');
    }

    /**
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getExactPeopleQuery(string $term)
    {
        return Person::public()->where('name', $term);
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
    private function getExactInvestorsQuery(string $term)
    {
        return Investor::where('name', $term);
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
    private function getExactResearchQuery(string $term)
    {
        return Research::where('name', $term);
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
    private function getExactLocationsQuery(string $term)
    {
        return Location::where('name', $term);
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
    private function getExactFocusQuery(string $term)
    {
        return Focus::where('name', $term);
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
    private function getExactEventsQuery(string $term)
    {
        return Event::where('name', $term);
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
    private function getExactJobsQuery(string $term)
    {
        return Job::where('job_title', $term);
    }

    /**
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getClinicalTrialsQuery(string $term)
    {
        return Clinicaltrial::where('title', 'like', '%' . $term . '%');
    }

    /**
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getExactClinicalTrialsQuery(string $term)
    {
        return Clinicaltrial::where('title', $term);
    }

    /**
     * @param string $searchTerm
     */
    private function logSearchTerm($searchTerm)
    {
        if ($searchTerm !== null) {
            $log          = new SearchLog();
            $log->term    = $searchTerm;
            $log->ip      = request()->ip();
            $log->user_id = auth()->check() ? auth()->user()->id : null;
            $log->save();
        }
    }
}
