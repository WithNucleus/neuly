<?php

namespace App\Models\ClinicalTrialDetails;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class CtOutcomeMeasure extends Model
{
    use CrudTrait;

    protected $table = 'ct_outcome_measures';

    public $fillable = ['value'];

    public $timestamps = false;
}
