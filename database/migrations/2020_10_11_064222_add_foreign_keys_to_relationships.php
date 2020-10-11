<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRelationships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinicaltrials', function (Blueprint  $table) {
           $table->bigIncrements('id')->change();
        });

        Schema::table('locations', function (Blueprint  $table) {
            $table->bigIncrements('id')->change();
        });

        Schema::table('people', function (Blueprint  $table) {
            $table->bigIncrements('id')->change();
        });

        Schema::table('clinicaltrial_company', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->change();
            $table->unsignedBigInteger('clinicaltrial_id')->change();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('clinicaltrial_id')
                ->references('id')
                ->on('clinicaltrials')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('clinicaltrial_focus', function (Blueprint  $table) {
            $table->unsignedBigInteger('focus_id')->change();
            $table->unsignedBigInteger('clinicaltrial_id')->change();

            $table->foreign('focus_id')
                ->references('id')
                ->on('focus')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('clinicaltrial_id')
                ->references('id')
                ->on('clinicaltrials')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('clinicaltrial_location', function (Blueprint $table) {
            $table->unsignedBigInteger('location_id')->change();
            $table->unsignedBigInteger('clinicaltrial_id')->change();

            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('clinicaltrial_id')
                ->references('id')
                ->on('clinicaltrials')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('clinicaltrial_person', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id')->change();
            $table->unsignedBigInteger('clinicaltrial_id')->change();

            $table->foreign('person_id')
                ->references('id')
                ->on('people')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('clinicaltrial_id')
                ->references('id')
                ->on('clinicaltrials')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('company_event', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->change();
            $table->unsignedBigInteger('event_id')->change();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('company_focus', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->change();
            $table->unsignedBigInteger('focus_id')->change();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('focus_id')
                ->references('id')
                ->on('focus')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('company_investor', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->change();
            $table->unsignedBigInteger('investor_id')->change();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('investor_id')
                ->references('id')
                ->on('investors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('company_location', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->change();
            $table->unsignedBigInteger('location_id')->change();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('company_person', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->change();
            $table->unsignedBigInteger('person_id')->change();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('person_id')
                ->references('id')
                ->on('people')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('company_research', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->change();
            $table->unsignedBigInteger('research_id')->change();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('research_id')
                ->references('id')
                ->on('research')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('focus_investor', function (Blueprint $table) {
            $table->unsignedBigInteger('focus_id')->change();
            $table->unsignedBigInteger('investor_id')->change();

            $table->foreign('focus_id')
                ->references('id')
                ->on('focus')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('investor_id')
                ->references('id')
                ->on('investors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('focus_job', function (Blueprint $table) {
            $table->unsignedBigInteger('focus_id')->change();
            $table->unsignedBigInteger('job_id')->change();

            $table->foreign('focus_id')
                ->references('id')
                ->on('focus')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('job_id')
                ->references('id')
                ->on('jobs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('focus_news_article', function (Blueprint $table) {
            $table->unsignedBigInteger('focus_id')->change();
            $table->unsignedBigInteger('news_article_id')->change();

            $table->foreign('focus_id')
                ->references('id')
                ->on('focus')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('news_article_id')
                ->references('id')
                ->on('news_articles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('focus_research', function (Blueprint $table) {
            $table->unsignedBigInteger('focus_id')->change();
            $table->unsignedBigInteger('research_id')->change();

            $table->foreign('focus_id')
                ->references('id')
                ->on('focus')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('research_id')
                ->references('id')
                ->on('research')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('investor_location', function (Blueprint $table) {
            $table->unsignedBigInteger('investor_id')->change();
            $table->unsignedBigInteger('location_id')->change();

            $table->foreign('investor_id')
                ->references('id')
                ->on('investors')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('investor_person', function (Blueprint $table) {
            $table->unsignedBigInteger('investor_id')->change();
            $table->unsignedBigInteger('person_id')->change();

            $table->foreign('investor_id')
                ->references('id')
                ->on('investors')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('person_id')
                ->references('id')
                ->on('people')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('job_location', function (Blueprint $table) {
            $table->unsignedBigInteger('job_id')->change();
            $table->unsignedBigInteger('location_id')->change();

            $table->foreign('job_id')
                ->references('id')
                ->on('jobs')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('location_person', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id')->change();
            $table->unsignedBigInteger('location_id')->change();

            $table->foreign('person_id')
                ->references('id')
                ->on('people')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('email_notifications', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('person_research', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id')->change();
            $table->unsignedBigInteger('research_id')->change();

            $table->foreign('person_id')
                ->on('people')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('research_id')
                ->on('research')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('email_resets', function (Blueprint  $table) {
            $table->unsignedBigInteger('user_id')->change();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('followables', function (Blueprint  $table) {
            $table->unsignedBigInteger('user_id')->change();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinicaltrial_company', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['clinicaltrial_id']);
        });

        Schema::table('clinicaltrial_company', function (Blueprint $table) {
            $table->bigInteger('company_id')->change();
            $table->bigInteger('clinicaltrial_id')->change();
        });

        Schema::table('clinicaltrial_focus', function (Blueprint $table) {
            $table->dropForeign(['focus_id']);
            $table->dropForeign(['clinicaltrial_id']);
        });

        Schema::table('clinicaltrial_focus', function (Blueprint $table) {
            $table->bigInteger('focus_id')->change();
            $table->bigInteger('clinicaltrial_id')->change();
        });

        Schema::table('clinicaltrial_location', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->dropForeign(['clinicaltrial_id']);
        });

        Schema::table('clinicaltrial_location', function (Blueprint $table) {
            $table->bigInteger('location_id')->change();
            $table->bigInteger('clinicaltrial_id')->change();
        });

        Schema::table('clinicaltrial_person', function (Blueprint $table) {
            $table->dropForeign(['person_id']);
            $table->dropForeign(['clinicaltrial_id']);
        });

        Schema::table('clinicaltrial_person', function (Blueprint $table) {
            $table->bigInteger('person_id')->change();
            $table->bigInteger('clinicaltrial_id')->change();
        });

        Schema::table('company_event', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['event_id']);
        });

        Schema::table('company_event', function (Blueprint $table) {
            $table->bigInteger('company_id')->change();
            $table->bigInteger('event_id')->change();
        });

        Schema::table('company_focus', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['focus_id']);
        });

        Schema::table('company_focus', function (Blueprint $table) {
            $table->bigInteger('company_id')->change();
            $table->bigInteger('focus_id')->change();
        });

        Schema::table('company_investor', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['investor_id']);
        });

        Schema::table('company_investor', function (Blueprint $table) {
            $table->bigInteger('company_id')->change();
            $table->bigInteger('investor_id')->change();
        });

        Schema::table('company_location', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['location_id']);
        });

        Schema::table('company_location', function (Blueprint $table) {
            $table->bigInteger('company_id')->change();
            $table->bigInteger('location_id')->change();
        });

        Schema::table('company_person', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['person_id']);
        });

        Schema::table('company_person', function (Blueprint $table) {
            $table->bigInteger('company_id')->change();
            $table->bigInteger('person_id')->change();
        });

        Schema::table('company_research', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['research_id']);
        });

        Schema::table('company_research', function (Blueprint $table) {
            $table->bigInteger('company_id')->change();
            $table->bigInteger('research_id')->change();
        });

        Schema::table('focus_investor', function (Blueprint $table) {
            $table->dropForeign(['focus_id']);
            $table->dropForeign(['investor_id']);
        });

        Schema::table('focus_investor', function (Blueprint $table) {
            $table->bigInteger('focus_id')->change();
            $table->bigInteger('investor_id')->change();
        });

        Schema::table('focus_job', function (Blueprint $table) {
            $table->dropForeign(['focus_id']);
            $table->dropForeign(['job_id']);
        });

        Schema::table('focus_job', function (Blueprint $table) {
            $table->bigInteger('focus_id')->change();
            $table->bigInteger('job_id')->change();
        });

        Schema::table('focus_news_article', function (Blueprint $table) {
            $table->dropForeign(['focus_id']);
            $table->dropForeign(['news_article_id']);
        });

        Schema::table('focus_news_article', function (Blueprint $table) {
            $table->bigInteger('focus_id')->change();
            $table->bigInteger('news_article_id')->change();
        });

        Schema::table('focus_research', function (Blueprint $table) {
            $table->dropForeign(['focus_id']);
            $table->dropForeign(['research_id']);
        });

        Schema::table('focus_research', function (Blueprint $table) {
            $table->bigInteger('focus_id')->change();
            $table->bigInteger('research_id')->change();
        });

        Schema::table('investor_location', function (Blueprint $table) {
            $table->dropForeign(['investor_id']);
            $table->dropForeign(['location_id']);
        });

        Schema::table('investor_location', function (Blueprint $table) {
            $table->bigInteger('investor_id')->change();
            $table->bigInteger('location_id')->change();
        });

        Schema::table('investor_person', function (Blueprint $table) {
            $table->dropForeign(['investor_id']);
            $table->dropForeign(['person_id']);
        });

        Schema::table('investor_person', function (Blueprint $table) {
            $table->bigInteger('investor_id')->change();
            $table->bigInteger('person_id')->change();
        });

        Schema::table('job_location', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
            $table->dropForeign(['location_id']);
        });

        Schema::table('job_location', function (Blueprint $table) {
            $table->bigInteger('job_id')->change();
            $table->bigInteger('location_id')->change();
        });

        Schema::table('location_person', function (Blueprint $table) {
            $table->dropForeign(['person_id']);
            $table->dropForeign(['location_id']);
        });

        Schema::table('location_person', function (Blueprint $table) {
            $table->bigInteger('person_id')->change();
            $table->bigInteger('location_id')->change();
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->bigInteger('user_id')->change();
        });

        Schema::table('email_notifications', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('email_notifications', function (Blueprint $table) {
            $table->bigInteger('user_id')->change();
        });

        Schema::table('person_research', function (Blueprint $table) {
            $table->dropForeign(['person_id']);
            $table->dropForeign(['research_id']);
        });

        Schema::table('person_research', function (Blueprint $table) {
            $table->bigInteger('person_id')->change();
            $table->bigInteger('research_id')->change();
        });

        Schema::table('email_resets', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('email_resets', function (Blueprint $table) {
            $table->bigInteger('user_id')->change();
        });

        Schema::table('followables', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('followables', function (Blueprint $table) {
            $table->bigInteger('user_id')->change();
        });

        Schema::table('clinicaltrials', function (Blueprint  $table) {
            $table->increments('id')->change();
        });

        Schema::table('locations', function (Blueprint  $table) {
            $table->increments('id')->change();
        });

        Schema::table('people', function (Blueprint  $table) {
            $table->increments('id')->change();
        });
    }
}
