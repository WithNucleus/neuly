<?php

namespace App\Models\ClinicalTrialDetails;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class CtCondition extends Model
{
    use CrudTrait;

    protected $table = 'ct_conditions';

    public $fillable = ['value'];

    public $timestamps = false;
}
