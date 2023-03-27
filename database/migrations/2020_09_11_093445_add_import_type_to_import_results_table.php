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
            $table->string('type')->after('id');
        });

        ImportResult::where('entity', 'Clinical Trials')->update(['type' => ImportResult::TYPE_CLINICAL_TRIALS]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('import_results', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
