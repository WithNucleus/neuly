<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class UpdateAllIdFieldsToUnsignedBigInteger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Artisan::call('clean:relations');

        Schema::table('event_event_type', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->change();
            $table->unsignedBigInteger('event_type_id')->change();

            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('event_type_id')
                ->references('id')
                ->on('event_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('event_focus', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->change();
            $table->unsignedBigInteger('focus_id')->change();

            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('focus_id')
                ->references('id')
                ->on('focus')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('event_location', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->change();
            $table->unsignedBigInteger('location_id')->change();

            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('event_person', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->change();
            $table->unsignedBigInteger('person_id')->change();

            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('person_id')
                ->references('id')
                ->on('people')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('firewall_ips', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->change();
            $table->unsignedBigInteger('log_id')->change();
        });

        Schema::table('firewall_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->change();
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_types', function (Blueprint $table) {
            $table->dropForeign(['event_id', 'event_type_id']);
        });

        Schema::table('event_focus', function (Blueprint $table) {
            $table->dropForeign(['event_id', 'focus_id']);
        });

        Schema::table('event_location', function (Blueprint $table) {
            $table->dropForeign(['event_id', 'location_id']);
        });

        Schema::table('event_person', function (Blueprint $table) {
            $table->dropForeign(['event_id', 'person_id']);
        });
    }
}
