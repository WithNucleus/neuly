<?php

namespace App\Models;

use App\User;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class RaisedClaim extends Model
{
    use CrudTrait;

    protected $table = 'raised_claims';
    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function person() {
        return $this->belongsTo(Person::class);
    }

    public function getUserName() {
        $user = User::find($this->user_id);
        return $user->name . ' ' . $user->last_name;
    }
}
