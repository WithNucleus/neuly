<?php

use App\Models\ImportResult;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateImportResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('import_results', function (Blueprint $table) {
            $table->string('entity')->nullable()->change();
        });

        //update old 'type' value
        ImportResult::where('type', 'related_entities')->update(['type' => ImportResult::TYPE_RELATED_ENTITIES_LOCATION]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('import_results', function (Blueprint $table) {
            $table->string('entity')->nullable(false)->change();
        });
    }
}
