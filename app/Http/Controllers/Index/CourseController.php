<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('discover.courses.index');
    }

    public function list(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('discover.courses.index-entity');
    }

    public function show($slug): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        $related = $this->getRelatedEntities($course);

        return view('discover.courses.show', [
           'course' => $course,
            'related' => $related
        ]);
    }

    private function getRelatedEntities(Course $course)
    {
        $focuses = $course->focus->pluck('id');

        $relatedIds = DB::table('course_focus')
                        ->select(['course_id', DB::raw('COUNT(course_id) as accurance')])
                        ->whereIn('focus_id', $focuses)
                        ->where('course_id', '!=', $course->id)
                        ->groupBy('course_id')
                        ->orderBy('accurance', 'desc')
                        ->take(6)
                        ->get()->pluck('course_id');

        return Course::whereIn('id', $relatedIds)->get();
    }
}
