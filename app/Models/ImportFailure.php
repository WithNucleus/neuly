<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportFailure extends Model
{
    const TYPE_LOCATIONS = 'locations';

    const TYPE_PEOPLE_ORGANIZATION = 'people_organization';

    const TYPE_SPONSOR_COLLABORATORS = 'sponsorcollaborators';

    const TYPE_IMAGE = 'image';

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'import_failures';

    protected $guarded = ['id'];

    protected $casts = [
        'details' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function result()
    {
        return $this->belongsTo(\App\Models\ImportResult::class, 'import_result_id', 'id');
    }
}
