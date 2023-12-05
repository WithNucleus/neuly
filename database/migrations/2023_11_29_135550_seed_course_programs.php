<?php

use App\Models\Course;
use App\Models\CourseProgram;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {

        $programs = Course::whereNotNull('program')->pluck('program')->unique()->toArray();

        foreach($programs as $program) {
            CourseProgram::create([
                'name' => trim($program)
            ]);
        }
    }

    public function down()
    {
        CourseProgram::truncate();
    }
};
