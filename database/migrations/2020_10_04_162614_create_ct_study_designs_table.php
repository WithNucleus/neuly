<?php

use App\Models\Clinicaltrial;
use App\Models\ClinicalTrialDetails\CtStudyDesign;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCtStudyDesignsTable extends Migration
{
    const CT_TABLE = 'clinicaltrials';

    const CT_ATTRIBUTE = 'study_designs';

    const CT_ATTRIBUTE_TABLE = 'ct_study_designs';

    const CT_ATTRIBUTE_RELATION_TABLE = 'clinicaltrial_study_design';

    const CT_FOREIGN_COLUMN_NAME = 'clinicaltrial_id';

    const CT_ATTRIBUTE_FOREIGN_COLUMN_NAME = 'ct_study_design_id';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::CT_ATTRIBUTE_TABLE, function (Blueprint $table) {
            $table->id();
            $table->string('value')->unique();
        });

        Schema::create(self::CT_ATTRIBUTE_RELATION_TABLE, function (Blueprint $table) {
            $table->unsignedInteger(self::CT_FOREIGN_COLUMN_NAME);
            $table->unsignedBigInteger(self::CT_ATTRIBUTE_FOREIGN_COLUMN_NAME);
            $table->foreign(self::CT_FOREIGN_COLUMN_NAME)
                ->references('id')
                ->on(self::CT_TABLE)
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign(self::CT_ATTRIBUTE_FOREIGN_COLUMN_NAME)
                ->references('id')
                ->on(self::CT_ATTRIBUTE_TABLE)
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        $this->migrateData();

        Schema::table(self::CT_TABLE, function (Blueprint $table) {
            $table->dropColumn(self::CT_ATTRIBUTE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(self::CT_TABLE, function (Blueprint $table) {
            $table->text(self::CT_ATTRIBUTE)->after('study_results');
        });

        Schema::dropIfExists(self::CT_ATTRIBUTE_RELATION_TABLE);
        Schema::dropIfExists(self::CT_ATTRIBUTE_TABLE);
    }

    /**
     * @return void
     */
    private function migrateData()
    {
        /**
         * @var array $cache
         * [relationValue => relationId]
         */
        $cache = [];

        Clinicaltrial::chunk(100, function ($clinicaltrials) use ($cache) {
            foreach ($clinicaltrials as $ct) {
                if (! empty($ct->{self::CT_ATTRIBUTE})) {
                    $relationIds = [];
                    $values = array_map('trim', explode('|', $ct->{self::CT_ATTRIBUTE}));

                    foreach ($values as $value) {
                        if (isset($cache[$value])) {
                            $relationIds[] = $cache[$value];
                        } else {
                            $entity = CtStudyDesign::firstOrCreate(['value' => $value]);
                            $relationIds[] = $entity->id;
                            $cache[$entity->value] = $entity->id;
                        }
                    }

                    $ct->studyDesigns()->attach($relationIds);
                }
            }
        });
    }
}
