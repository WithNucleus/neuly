<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportResult extends Model
{
	protected $table = 'import_results';
    protected $guarded = ['id'];

    // Each import result can have 1 focus
    public function focus() {
        return $this->belongsTo('App\Models\Focus');
    }
}
