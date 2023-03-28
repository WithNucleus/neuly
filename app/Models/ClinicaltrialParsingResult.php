<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class ClinicaltrialParsingResult extends Model
{
    use CrudTrait;

    protected $table = 'clinicaltrial_parsing_results';

    protected $guarded = ['id'];

    public function clinicaltrial()
    {
        return $this->belongsTo(Clinicaltrial::class);
    }
}
