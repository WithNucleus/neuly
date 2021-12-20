<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function invitations()
    {
        return $this->hasMany(TeamInvitation::class);
    }

    public function addMember($user)
    {
        $this->members()->attach($user->id);
    }

    public function removeMember($user)
    {
        $this->members()->detach($user->id);
    }
}
