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

    public static function generateToken()
    {
        return sha1(time());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function getUserName()
    {
        $user = User::find($this->user_id);
        return $user->name.' '.$user->last_name;
    }

    public function getApproveButton()
    {
        return '<a href="/admin/person-claim/approve/'.$this->id.'" class="btn btn-sm btn-link"><i class="la la-thumbs-up"></i> approve claim</a>';
    }
}
