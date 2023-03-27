<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ApiUser extends Authenticatable
{
    use CrudTrait;
    use HasFactory;

    const PERMISSION_LEVEL_READ = 1;

    const PERMISSION_LEVEL_WRITE = 2;

    protected $guarded = ['id'];

    public function hasWritePermission()
    {
        return $this->permission_level === self::PERMISSION_LEVEL_WRITE;
    }
}
