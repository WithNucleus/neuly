<?php

namespace App\Models\ClinicalTrialDetails;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class CtStudyDesign extends Model
{
    use CrudTrait;

    protected $table = 'ct_study_designs';

    public $fillable = ['value'];

    public $timestamps = false;
}
