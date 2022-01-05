<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NavigationTile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const MENU_BG_COLOR = '#212529';
    const MENU_LINK_COLOR = '#fefefe';
    const MENU_LINK_HOVER_COLOR = '#fefefe';
    const BUTTON_BG = '#212529';
    const TITLE_COLOR = '#6bbca4';
    const TITLE_BORDER_COLOR = '#275DAD';
    const BADGE_BG = '#f0f600';
    const BADGE_COLOR = '#212529';

    public function navItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(NavigationTileItem::class)->orderBy('order', 'asc')->orderBy('name', 'asc');
    }

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
