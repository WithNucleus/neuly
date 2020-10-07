<?php

namespace App\Jobs\Import\ClinicalTrial;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Clinicaltrial;

class ProcessSimpleRelationValues implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Models\Clinicaltrial
     */
    private $clinicaltrial;

    /**
     * @var array
     */
    private $values;

    /**
     * @var string
     */
    private $relationName;

    /**
     * @var string
     */
    private $relationClass;

    /**
     * ProcessLocation constructor.
     * @param \App\Models\Clinicaltrial $clinicaltrial
     * @param array $values
     * @param string $relationName
     */
    public function __construct(Clinicaltrial $clinicaltrial, array $values, string $relationName)
    {
        $this->clinicaltrial  = $clinicaltrial;
        $this->values         = $values;
        $this->relationName   = $relationName;
        $this->relationClass  = get_class($clinicaltrial->{$relationName}()->getRelated());
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $relationIds = [];

        foreach ($this->valuesArray as $value) {
            $entity = $this->relationClass::firstOrCreate(['value' => $value]);
            $relationIds[] = $entity->id;
        }

        $this->clinicaltrial->{$this->relationName}()->syncWithoutDetaching($relationIds);
    }
}
