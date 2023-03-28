<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Focus;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('query_filters')->only('index');
    }

    public function index()
    {
        $courses = QueryBuilder::for(Course::class)
            ->where('schedule', '!=', Course::SCHEDULE_PAST)
            ->with(['focus'])
            ->allowedSorts([
                'name',
                AllowedSort::field('price', 'lowest_cost'),
            ])
            ->defaultSort('name')
            ->allowedFilters([
                AllowedFilter::partial('focus', 'focus.name'),
                AllowedFilter::exact('type', 'type'),
                AllowedFilter::partial('education_credits'),
            ])
            ->paginate(15)
            ->appends(request()->query());

        $focus_cats = Focus::whereHas('courses')->orderBy('name')->pluck('name')->toArray();
        $types = Course::TYPES;

        return view('discover.courses.index', compact('courses', 'focus_cats', 'types'));
    }
}
