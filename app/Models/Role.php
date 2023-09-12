<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends \Spatie\Permission\Models\Role
{
    const ROLE_ADMIN = 'Admin';
    const ROLE_EDITOR = 'Editor';
    const ROLE_SUBSCRIBER = 'Subscriber';
    const ROLE_ENTERPRISE = 'Enterprise';
    const ROLE_TEAM_OWNER = 'Team owner';
    const ROLE_TEAM_MEMBER = 'Team member';
    const ROLE_PI_PRO = 'PI PRO';

    // Unused as of 09/08/2023
    const ROLE_PREMIUM = 'Premium';
    const ROLE_PROFESSIONAL = 'Professional';

    public function getColorAttribute(): string
    {
        return match($this->name) {
            self::ROLE_ADMIN => 'bg-accent',
            self::ROLE_EDITOR => 'bg-success',
            self::ROLE_TEAM_OWNER, self::ROLE_TEAM_MEMBER => 'bg-tertiary',
            self::ROLE_PI_PRO, self::ROLE_ENTERPRISE => 'bg-primary',
            default => 'bg-body-secondary text-body'
        };
    }
}
