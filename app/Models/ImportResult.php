<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportResult extends Model
{
    const TYPE_CLINICAL_TRIALS = 'clinical_trials';
    const TYPE_RELATED_ENTITIES = 'related_entities';

	protected $table = 'import_results';
    protected $guarded = ['id'];

    // Each import result can have 1 focus
    public function focus() {
        return $this->belongsTo('App\Models\Focus');
    }

    public function failures()
    {
        return $this->hasMany('App\Models\ImportFailure', 'import_result_id', 'id');
    }

    public function scopeClinicalTrials($query)
    {
        return $query->where('type', self::TYPE_CLINICAL_TRIALS);
    }

    public function scopeRelatedEntities($query)
    {
        return $query->where('type', self::TYPE_RELATED_ENTITIES);
    }
}
