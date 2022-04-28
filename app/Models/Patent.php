<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Patent extends Model
{
    use CrudTrait;
    use LogsActivity;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'patents';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    protected $dates = [
        'priority_date',
        'granted_date',
        'expiration_date',
    ];

    protected static $logUnguarded = true;
    protected static $logName = 'entities';

     const STATUSES_ACTIVE = [
        'Filed',
        'Pending',
        'Published',
        'Granted'
     ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function companies(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Company::class, 'entity' , 'patent_relationships')->withTimestamps();
    }

    public function focus(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Focus::class, 'entity' , 'patent_relationships')->withTimestamps();
    }

    public function people(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Person::class, 'entity' , 'patent_relationships')->withTimestamps();
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
