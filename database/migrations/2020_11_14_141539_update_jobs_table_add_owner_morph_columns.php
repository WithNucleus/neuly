<?php

use App\Models\Company;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateJobsTableAddOwnerMorphColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('owner_id')->after('company_id');
            $table->string('owner_type')->after('owner_id');
        });

        DB::table('jobs')->update([
            'owner_id' => DB::raw('company_id'),
            'owner_type' => Company::class
        ]);

        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->after('owner_type');
        });

        DB::table('jobs')
            ->where('owner_type', Company::class)
            ->update(['company_id' => DB::raw('owner_id')]);

        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['owner_id', 'owner_type']);
        });
    }
}
