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

    public function scopeEnterpriseCombinedFeed($query)
    {
        $query->where('media_type', MediaTypes::MEDIA_TYPE_NEWS)
            ->orWhere('media_type', MediaTypes::MEDIA_TYPE_ARTICLE)
            ->orWhere('media_type', MediaTypes::MEDIA_TYPE_VIDEO)
            ->orWhere('media_type', MediaTypes::MEDIA_TYPE_PODCAST)
            ->orWhere('media_type', MediaTypes::MEDIA_TYPE_PATENT_FILING);
    }

    public function scopeImages($query)
    {
        $query->where('media_type', MediaTypes::MEDIA_TYPE_IMAGE);
    }

    public function scopeMixed($query)
    {
        $query->where('media_type', MediaTypes::MEDIA_TYPE_MIXED);
    }

    public function scopeNews($query)
    {
        $query->where('media_type', MediaTypes::MEDIA_TYPE_NEWS);
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


    public function getMediaIconAttribute(): string
    {
        return [
                MediaTypes::MEDIA_TYPE_ARTICLE => '<i class="fad fa-file-alt"></i>',
                MediaTypes::MEDIA_TYPE_IMAGE => '<i class="fad fa-image"></i>',
                MediaTypes::MEDIA_TYPE_VIDEO => '<i class="fad fa-video"></i>',
                MediaTypes::MEDIA_TYPE_PODCAST => '<i class="fad fa-podcast"></i>',
                MediaTypes::MEDIA_TYPE_BOOK => '<i class="fad fa-book fa-fw"></i>',
                MediaTypes::MEDIA_TYPE_NEWS => '<i class="fad fa-newspaper fa-fw"></i>',
                MediaTypes::MEDIA_TYPE_PATENT_FILING => '<i class="fad fa-cabinet-filing"></i>',
            ][$this->media_type] ?? '<i class="fad fa-photo-video"></i>';
    }

}
