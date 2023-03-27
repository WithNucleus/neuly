<?php

use App\Models\Focus;
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
        Schema::table('focus', function (Blueprint $table) {
            $table->string('type')->nullable()->after('slug');
        });

        $drugFocusNames = [
            'Psilocybin',
            'MDMA',
            'LSD',
            'DMT',
            'Tryptamine',
            'Ketamine',
            'Ibogaine',
            'GHB',
            'Iboga',
            'Ayahuasca',
            'Arketamine',
            'Mescaline',
            'Noribogaine',
        ];

        Focus::whereIn('name', $drugFocusNames)->update(['type' => Focus::TYPE_DRUG]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('focus', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
