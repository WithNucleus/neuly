<?php

namespace App\Models\Traits;

use App\Models\EntityContent;

trait HasEntityContent
{
    public function content(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(EntityContent::class, 'entity')->orderBy('order', 'asc');
    }
}
