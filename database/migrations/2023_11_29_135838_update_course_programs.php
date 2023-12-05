<?php

use App\Models\Course;
use App\Models\CourseProgram;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        $courses = Course::whereNotNull('program')->take(10)->get();
        $coursePrograms = CourseProgram::all()->pluck('name', 'id')->toArray();

        foreach($courses as $course) {
            $currentProgram = trim($course->program);

            echo $currentProgram;

            $programId = array_search($currentProgram, $coursePrograms);
            if ($programId) {
                echo $programId;
            }
        }
    }

    public function down()
    {
        //
    }
};
