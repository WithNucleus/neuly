<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptIn extends Model
{
    use HasFactory;

    const FORM_HOMEPAGE_HERO = 'Homepage Hero';

    protected $guarded = ['id'];
    protected $casts = [
        'data' => 'array'
    ];
}
