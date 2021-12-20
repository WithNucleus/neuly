<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VisibilityOptionsForCompaniesAndPeople extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Drop Original Visibility Column for People
        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn('visibility');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->string('visibility')->default('public')->after('logo');
            $table->string('visibility_code')->nullable()->after('visibility');
        });

        Schema::table('people', function (Blueprint $table) {
            $table->string('visibility')->default('public')->after('photo');
            $table->string('visibility_code')->nullable()->after('visibility');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('visibility');
            $table->dropColumn('visibility_code');
        });

        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn('visibility');
            $table->dropColumn('visibility_code');
        });

        Schema::table('people', function (Blueprint $table) {
            $table->enum('visibility', ['neuly', 'public'])->default('public');
        });
    }
}
