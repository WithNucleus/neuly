<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('summary', 9999)->nullable()->after('notes');
            $table->date('founded_date')->nullable()->after('summary');
            $table->decimal('valuation', 60, 0)->nullable()->after('founded_date');
            $table->decimal('total_funding_amount', 60, 0)->nullable()->after('valuation');
            $table->decimal('number_employees', 60, 0)->nullable()->after('total_funding_amount');
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
            $table->dropColumn('summary');
            $table->dropColumn('founded_date');
            $table->dropColumn('valuation');
            $table->dropColumn('total_funding_amount');
            $table->dropColumn('number_employees');
        });
    }
}
