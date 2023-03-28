<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LocationsGeocoding extends Model
{
    use CrudTrait;

    protected $table = 'location_geocoding';

    protected $casts = [
        'finished_at' => 'datetime',
        'payload' => 'array',
        'processed' => 'array',
        'failed' => 'array',
    ];

    public static function canBeStarted()
    {
        return self::where('finished_at', '>', Carbon::now()->subDay())
                ->orWhereNull('finished_at')
                ->count() === 0;
    }
}
