<?php

namespace App\Models\ClinicalTrialDetails;

use App\Models\Clinicaltrial;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class CtOutcomeMeasure extends Model
{
    use CrudTrait;

    protected $table = 'ct_outcome_measures';

    public $fillable = ['value'];

    public $timestamps = false;

    public function clinicalTrials()
    {
        return $this->belongsToMany(Clinicaltrial::class, 'clinicaltrial_outcome_measure');
    }
}
