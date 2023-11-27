<?php

use App\Models\EmploymentType;
use App\Models\Job;
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
        $types = [
            'Full Time',
            'Part Time',
            'Contract',
            'Temporary'
        ];

        foreach($types as $type) {
            EmploymentType::create([
                'name' => $type
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        EmploymentType::truncate();
    }
};
