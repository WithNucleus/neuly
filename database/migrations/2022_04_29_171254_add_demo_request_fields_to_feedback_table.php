<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddDemoRequestFieldsToFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->string('organization')->after('user_email')->nullable();
            $table->string('job_title')->after('organization')->nullable();
        });

        DB::statement("ALTER TABLE feedback MODIFY COLUMN type ENUM('problem', 'feedback', 'bug', 'suggestion', 'feature request', 'demo request')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->dropColumn('organization');
            $table->dropColumn('job_title');
        });

        DB::statement("ALTER TABLE feedback MODIFY COLUMN type ENUM('problem', 'feedback', 'bug', 'suggestion', 'feature request')");
    }
}
