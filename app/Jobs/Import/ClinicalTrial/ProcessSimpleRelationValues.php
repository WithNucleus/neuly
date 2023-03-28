<?php

namespace App\Jobs\Import\ClinicalTrial;

use App\Models\Clinicaltrial;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
     */
    public function __construct(Clinicaltrial $clinicaltrial, array $values, string $relationName)
    {
        $this->clinicaltrial = $clinicaltrial;
        $this->values = $values;
        $this->relationName = $relationName;
        $this->relationClass = get_class($clinicaltrial->{$relationName}()->getRelated());
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $relationIds = [];

        foreach ($this->values as $value) {
            $entity = $this->relationClass::firstOrCreate(['value' => $value]);
            $relationIds[] = $entity->id;
        }

        $this->clinicaltrial->{$this->relationName}()->syncWithoutDetaching($relationIds);
    }
}
