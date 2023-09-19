<?php

namespace App\Http\Livewire\Public\Featured;

use App\Http\Livewire\Public\Entities\Traits\HasCompanyFilter;
use App\Http\Livewire\Public\Traits\LocalLocationFilter;
use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Course;
use App\Models\EduRequest;
use App\Models\Focus;
use App\Models\SearchLog;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NeulyEduCourses extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting, HasCompanyFilter, LocalLocationFilter;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;

    public array $filters = [
        'focus' => [],
        'companies' => [],
        'education' => [],
        'type' => [],
        'education-credits' => null,
        'free' => null,
        'open-enrollment' => null,
        'self-paced' => null,
        'delivery-method' => []
    ];

    public string $ip;
    public ?int $userId = null;
    public array $localLocation = [
        'latitude' => null,
        'longitude' => null,
        'name' => null,
        'id' => null
    ];

    public $name;
    public $email;
    public $message;

    public bool $noCoursesConcierge = false;
    public bool $conciergeSuccess = false;

    public function mount(Request $request) {
        $this->ip = $request->getClientIp(); // PRODUCTION

        $this->sorts = [
            'name' => 'asc'
        ];

        $this->perPage = 15;

        $this->getLocalLocation();

        if (Auth::id()) {
            $user = User::findOrFail(Auth::id());
            $this->userId = $user->id;
            $this->name = $user->full_name;
            $this->email = $user->email;
        }
    }

    public function updatingSearch() {
        $this->resetPage();
    }

    public function updatingFilters() {
        $this->resetPage();
    }

    public function clearSearch() {
        $this->reset('search');
        $this->resetPage();
    }

    public function clearFilters() {
        $this->reset('search');
        $this->reset('filters');
        $this->reset('sorts');
        $this->reset('companySearch');
        $this->reset('companySearchResults');
        $this->resetPage();

        $this->sorts = [
            'lowest_cost' => 'asc'
        ];
    }

    public function clearFilter($filter, $id) {
        unset($this->filters[$filter][$id]);
        $this->resetPage();
    }

    public function gotoPage($page)
    {
        $this->setPage($page);
        $this->emit('gotoTop');
    }

    public function nextPage()
    {
        $this->setPage($this->page + 1);
        $this->emit('gotoTop');
    }

    public function previousPage()
    {
        $this->setPage(max($this->page - 1, 1));
        $this->emit('gotoTop');
    }

    public function updatedCompanySearch() {
        $this->returnCompanySearch('courses');
    }

    public function goListing($id) {
        $course = Course::find($id);

        SearchLog::create([
            'term' => $this->search ?? 'empty',
            'type' => SearchLog::TYPE_NEULY_EDU_COURSES,
            'ip' => $this->ip,
            'data' => [
                'filters' => $this->filters,
                'locations' => [
                    'local' => $this->localLocation,
                ]
            ],
            'relatable_type' => Course::class,
            'relatable_id' => $course->id,
            'user_id' => $this->userId
        ]);

        $this->dispatchBrowserEvent('redirect-to-url', ['url' => route('discover.courses.show', $course->slug)]);

    }

    public function rules() {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ];
    }

    public function submit() {
        $this->validate();

        EduRequest::create([
            'name' => $this->name,
            'email' => $this->email,
            'type' => EduRequest::TYPE_COURSE_NO_MATCHES,
            'status' => EduRequest::STATUS_OPEN,
            'message' => $this->message,
            'data' => [
                'search' => $this->search,
                'filters' => $this->filters,
                'locations' => [
                    'local' => $this->localLocation,
                ]
            ],
            'user_id' => $this->userId,
            'ip' => $this->ip,
        ]);

        $this->noCoursesConcierge = true;
        $this->reset('message');

    }

    public function submitConcierge() {
        $this->validate();

        EduRequest::create([
            'name' => $this->name,
            'email' => $this->email,
            'type' => EduRequest::TYPE_COURSE_CONCIERGE,
            'status' => EduRequest::STATUS_OPEN,
            'message' => $this->message,
            'data' => [
                'search' => $this->search,
                'filters' => $this->filters,
                'locations' => [
                    'local' => $this->localLocation,
                ]
            ],
            'user_id' => $this->userId,
            'ip' => $this->ip
        ]);

        $this->conciergeSuccess = true;
        $this->reset('message');

    }

    public function getRowsQueryProperty()
    {
        $query = Course::with(['companies', 'focus'])
                ->when($this->search, function($query, $search) {
                    return $query
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('summary', 'like', '%' . $search . '%')
                        ->orWhere('type', 'like', '%' . $search . '%')
                        ->orWhere('education_credits', 'like', '%' . $search . '%')
                        ->orwhereHas('focus', function($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                })
                ->when($this->filters['type'], function($query, $valueArray) {
                    return $query->whereIn('type', $valueArray);
                })
                ->when($this->filters['education'], function($query, $valueArray) {
                    $query->whereIn('education_credits', $valueArray);
                })
                ->when($this->filters['delivery-method'], function($query, $valueArray) {
                    $query->whereIn('delivery_method', $valueArray);
                })
                ->when($this->filters['focus'], function($query, $valueArray) {
                    return $query->whereHas('focus', function($query) use ($valueArray) {
                        $query->whereIn('name', $valueArray);
                    });
                })
                ->when($this->filters['companies'], function($query, $valueArray) {
                    return $query->whereHas('companies', function($query) use ($valueArray) {
                        $query->whereIn('name', $valueArray);
                    });
                })
                ->when($this->filters['education-credits'], function($query) {
                    return $query->whereNotNull('education_credits');
                })
                ->when($this->filters['free'], function($query) {
                    return $query->where('lowest_cost', 0);
                })
                ->when($this->filters['open-enrollment'], function($query) {
                    return $query->where('open_enrollment', 1);
                })
                ->when($this->filters['self-paced'], function($query) {
                    return $query->where('self_paced', 1);
                });

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function render()
    {
        return view('livewire.public.featured.neuly-edu-courses', [
            'records' => $this->rows,
            'focusOptions' => Focus::whereHas('courses')->withCount('courses')->orderByDesc('courses_count')->get()->toArray(),
            'typeOptions' => Course::whereNotNull('type')->orderBy('type')->pluck('type')->unique()->toArray(),
            'deliveryMethodOptions' => Course::whereNotNull('delivery_method')->orderBy('delivery_method')->pluck('delivery_method')->unique()->toArray(),
            'educationOptions' => Course::whereNotNull('education_credits')->pluck('education_credits')->unique()->sort()->toArray()
        ]);
    }
}
