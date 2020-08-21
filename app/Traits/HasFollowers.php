<?php

namespace App\Traits;

use App\User;

trait HasFollowers {
    public function followers()
    {
        return $this->morphToMany(User::class, 'followable')->withTimestamps();
    }
}
