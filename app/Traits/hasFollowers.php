<?php

namespace App\Traits;

use App\User;

trait hasFollowers {
    public function followers()
    {
        return $this->morphToMany(User::class, 'followable');
    }
}
