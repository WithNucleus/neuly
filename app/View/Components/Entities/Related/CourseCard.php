<?php

namespace App\View\Components\Entities\Related;

use App\Models\Course;
use Illuminate\View\Component;

class CourseCard extends Component
{
    public Course $course;
    public ?string $classes;

    public function __construct(Course $course, ?string $classes = null)
    {
        $this->course = $course;
        $this->classes = $classes;
    }

    public function render()
    {
        return view('components.entities.related.course-card');
    }
}
