<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('clinicaltrials', function (Blueprint $table) {
            $table->string('start_date_type')->nullable()->after('start_date');
            $table->string('primary_completion_date_type')->nullable()->after('primary_completion_date');
            $table->string('completion_date_type')->nullable()->after('completion_date');
            $table->string('first_posted_type')->nullable()->after('first_posted');
            $table->string('results_first_posted_type')->nullable()->after('results_first_posted');
            $table->boolean('has_results')->nullable()->after('status');
            $table->boolean('healthy_volunteers')->nullable()->after('detailed_description');
            $table->longText('eligibility_criteria')->nullable()->after('healthy_volunteers');
            $table->string('enrollment_type')->nullable()->after('enrollment');
            $table->string('allocation')->nullable()->after('enrollment_type');
            $table->string('primary_purpose')->nullable()->after('allocation');
            $table->string('intervention_model')->nullable()->after('primary_purpose');
            $table->mediumText('intervention_model_description')->nullable()->after('intervention_model');
            $table->mediumText('official_title')->nullable()->after('title');
            $table->json('primary_outcomes')->nullable()->after('detailed_description');
            $table->json('secondary_outcomes')->nullable()->after('primary_outcomes');
            $table->json('other_outcomes')->nullable()->after('secondary_outcomes');
            $table->json('arm_groups')->nullable()->after('other_outcomes');
            $table->string('masking')->nullable()->after('arm_groups');
            $table->mediumText('masking_description')->nullable()->after('masking');
            $table->json('who_masked')->nullable()->after('masking_description');
            $table->nullableMorphs('lead_sponsor');
            $table->string('lead_sponsor_notes')->nullable();
            $table->string('lead_sponsor_agency_class')->nullable();
            $table->nullableMorphs('responsible_party');
            $table->string('responsible_party_notes')->nullable();
            $table->json('age_groups')->nullable()->after('age');
            $table->string('time_perspective')->nullable()->after('masking_description');
            $table->string('observational_model')->nullable()->after('time_perspective');
        });
    }

    public function down()
    {
        Schema::table('clinicaltrials', function (Blueprint $table) {
            $table->dropColumn('start_date_type');
            $table->dropColumn('primary_completion_date_type');
            $table->dropColumn('completion_date_type');
            $table->dropColumn('first_posted_type');
            $table->dropColumn('results_first_posted_type');
            $table->dropColumn('has_results');
            $table->dropColumn('healthy_volunteers');
            $table->dropColumn('eligibility_criteria');
            $table->dropColumn('enrollment_type');
            $table->dropColumn('allocation');
            $table->dropColumn('primary_purpose');
            $table->dropColumn('intervention_model');
            $table->dropColumn('intervention_model_description');
            $table->dropColumn('official_title');
            $table->dropColumn('primary_outcomes');
            $table->dropColumn('secondary_outcomes');
            $table->dropColumn('other_outcomes');
            $table->dropColumn('arm_groups');
            $table->dropColumn('masking');
            $table->dropColumn('masking_description');
            $table->dropColumn('who_masked');
            $table->dropMorphs('lead_sponsor');
            $table->dropColumn('lead_sponsor_notes');
            $table->dropColumn('lead_sponsor_agency_class');
            $table->dropMorphs('responsible_party');
            $table->dropColumn('responsible_party_notes');
            $table->dropColumn('age_groups');
            $table->dropColumn('time_perspective');
            $table->dropColumn('observational_model');
        });
    }
};
