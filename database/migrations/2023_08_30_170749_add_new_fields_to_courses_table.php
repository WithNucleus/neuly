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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('learning_location')->nullable()->after('type');
            $table->string('delivery_method')->nullable()->after('learning_location');

            $table->date('finish_date')->nullable()->after('next_date');
            $table->string('next_date_string')->nullable()->after('next_date');

            $table->string('currency')->nullable()->after('highest_cost');

            $table->boolean('open_enrollment')->default(0)->after('finish_date');
            $table->boolean('self_paced')->default(0)->after('open_enrollment');
            $table->string('length')->nullable()->after('open_enrollment');

            $table->string('hours')->nullable()->after('education_credits');
            $table->string('awarded')->nullable()->after('hours');

            $table->dropColumn('schedule');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('learning_location');
            $table->dropColumn('delivery_method');
            $table->dropColumn('finish_date');
            $table->dropColumn('next_date_string');
            $table->dropColumn('currency');
            $table->dropColumn('open_enrollment');
            $table->dropColumn('self_paced');
            $table->dropColumn('hours');
            $table->dropColumn('awarded');
            $table->string('schedule')->nullable();
        });
    }
};
