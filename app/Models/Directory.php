<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Directory extends Model
{
    use HasFactory, CrudTrait;

    protected $guarded = ['id'];

    public function bookableListings(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(BookableListing::class)->withTimestamps();
    }
}
