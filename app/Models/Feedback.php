<?php

namespace App\Models;

use App\User;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'feedback';
    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getStatusName()
    {
        return ucfirst($this->status);
    }

    public function getTypeName()
    {
        return ucfirst($this->type);
    }

    public function getUserName()
    {
        $name = $this->user_name;

        if($this->user_id !== null)
        {
            $user = User::find($this->user_id);
            $name = $user->name;
        }

        return $name;
    }

    public function getUserEmail()
    {
        $email = $this->user_email;

        if($this->user_id !== null)
        {
            $user = User::find($this->user_id);
            $email = $user->email;
        }

        return $email;
    }

    public function getAssigneeName()
    {
        $assignee = 'Unassigned';

        if($this->assignee_id !== null)
        {
            $user = User::find($this->assignee_id);
            $assignee = $user->name;
        }

        return $assignee;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function assignee()
    {
        return $this->belongsTo('App\User', 'assignee_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
