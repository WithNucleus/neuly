<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $jobs = \App\Models\Job::all();
        $employmentTypes = \App\Models\EmploymentType::pluck('name', 'id')->toArray();

        foreach($jobs as $job) {
            $type = $job->employment_type;
            $newType = match($type) {
                'Full Time' => 'Full Time',
                'Part Time' => 'Part Time',
                default => 'Contract'
            };

            $typeId = array_search($newType, $employmentTypes);

            $job->employmentTypes()->attach($typeId);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

};
