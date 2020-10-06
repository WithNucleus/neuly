<?php

namespace App\Models\ClinicalTrialDetails;

use App\Models\Clinicaltrial;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class CtIntervention extends Model
{
    use CrudTrait;

    protected $table = 'ct_interventions';

    public $fillable = ['value'];

    public $timestamps = false;

    public function clinicalTrials()
    {
        return $this->belongsToMany(Clinicaltrial::class, 'clinicaltrial_intervention');
    }
}
