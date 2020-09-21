<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class LogEmbed extends Model
{
    use CrudTrait;

    protected $table = 'log_embed';
}
