<?php

namespace App\Models;

use App\Models\Traits\EntityImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory, EntityImage;

    protected $guarded = [];
    public $incrementing = false;

    protected $casts = [
        'date' => 'datetime',
        'sticky' => 'boolean'
    ];

    const STATUS_PUBLISHED = 'publish';

    protected static $imageAttribute = 'image';
    protected static $imageFolderPath = 'reports';
    protected static $imageFilenameAttribute = 'id';

    /* Scopes */
    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    /* Relationships */
    public function focus(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Focus::class)->withTimestamps();
    }

    /* Accessors */
    public function getReadingTimeAttribute(): string
    {
        $word_count = str_word_count( strip_tags($this->content) );
        $reading_time = ceil($word_count / 200);
        $timer = " min read";
        return $reading_time . $timer;
    }
}
