<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportFailure extends Model
{
    const TYPE_SPONSOR_COLLABORATORS = 'Sponsor/Collaborators';

    protected $table = 'import_failures';

    protected $guarded = ['id'];

    protected $casts = [
        'details' => 'array',
    ];

    public function result()
    {
        return $this->belongsTo('App\Models\ImportResults', 'import_result_id', 'id');
    }
}
