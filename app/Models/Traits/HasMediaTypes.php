<?php

namespace App\Models\Traits;

use App\Enum\MediaTypes;

trait HasMediaTypes {

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function getMediaTypes(): array
    {
        return array_combine(MediaTypes::MEDIA_TYPES, MediaTypes::MEDIA_TYPES);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeArticles($query)
    {
        $query->where('media_type', MediaTypes::MEDIA_TYPE_ARTICLE);
    }

    public function scopeBooks($query)
    {
        $query->where('media_type', MediaTypes::MEDIA_TYPE_BOOK);
    }

    public function scopeImages($query)
    {
        $query->where('media_type', MediaTypes::MEDIA_TYPE_IMAGE);
    }

    public function scopeMixed($query)
    {
        $query->where('media_type', MediaTypes::MEDIA_TYPE_MIXED);
    }

    public function scopePatentFilings($query)
    {
        $query->where('media_type', MediaTypes::MEDIA_TYPE_PATENT_FILING);
    }

    public function scopePodcasts($query)
    {
        $query->where('media_type', MediaTypes::MEDIA_TYPE_PODCAST);
    }

    public function scopeVideos($query)
    {
        $query->where('media_type', MediaTypes::MEDIA_TYPE_VIDEO);
    }

}
