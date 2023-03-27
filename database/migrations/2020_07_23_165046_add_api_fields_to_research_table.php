<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('research', function (Blueprint $table) {
            $table->string('publication_info', 500)->nullable()->after('publish_date');
            $table->string('api_identifier')->nullable()->after('publication_info');
            $table->longText('resources')->nullable()->after('api_identifier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('research', function (Blueprint $table) {
            $table->dropColumn('publication_info');
            $table->dropColumn('api_identifier');
            $table->dropColumn('resources');
        });
    }
};
