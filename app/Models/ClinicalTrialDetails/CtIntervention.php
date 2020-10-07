<?php

namespace App\Models\ClinicalTrialDetails;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class CtIntervention extends Model
{
    use CrudTrait;

    protected $table = 'ct_interventions';

    public $fillable = ['value'];

    public $timestamps = false;
}
