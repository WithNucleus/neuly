<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportSetting extends Model
{
	protected $table = 'import_settings';

    protected $guarded = ['id'];

    public $timestamps = false;

    protected $casts = [
        'mapping_organisation' => 'array',
    ];
}
