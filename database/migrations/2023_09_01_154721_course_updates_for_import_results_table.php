<?php

use App\Models\ImportResult;
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
        Schema::table('import_results', function (Blueprint $table) {
            $table->string('status')->nullable()->after('entity');
            $table->string('notes')->nullable()->after('status');
            $table->json('data')->nullable()->after('focus_id');
            $table->json('errors')->nullable()->after('data');

            $table->integer('rows')->nullable()->after('notes');

            $table->json('location_messages')->nullable()->change();
            $table->json('people_messages')->nullable()->change();
            $table->json('company_messages')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('import_results', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('notes');
            $table->dropColumn('data');
            $table->dropColumn('errors');
            $table->dropColumn('rows');


            $table->longText('location_messages')->nullable()->change();
            $table->longText('people_messages')->nullable()->change();
            $table->longText('company_messages')->nullable()->change();
        });
    }
};
