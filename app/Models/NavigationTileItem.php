<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavigationTileItem extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function navigationTile(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(NavigationTile::class);
    }

    public function getMenuHtmlAttribute(): string
    {
        $html = '<li class="nav-tile-item" data-nav-link-id="' . $this->id . '">';
        $html .= '<div class="d-flex justify-content-between align-items-center">';
        $html .= '<span class="' . $this->type . '">';

        if ($this->url == '') {
            $html .= $this->name;
        } else {
            $html .= '<a href="' . $this->url . '" target="_blank" rel="noopener noreferrer">' . $this->name . '</a>';
        }

        $html .= '</div></li>';

        if ($this->badge != '') {
            $html .= '<span class="badge badge-info">' . $this->badge .'</span>';
        }

        return $html;
    }
}
