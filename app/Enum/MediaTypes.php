<?php

namespace App\Enum;

class MediaTypes {
    const MEDIA_TYPE_ARTICLE = 'Article';
    const MEDIA_TYPE_IMAGE = 'Image';
    const MEDIA_TYPE_VIDEO = 'Video';
    const MEDIA_TYPE_MIXED = 'Mixed';
    const MEDIA_TYPE_PODCAST = 'Podcast';
    const MEDIA_TYPE_BOOK = 'Book';
    const MEDIA_TYPE_NEWS = 'News';

    const MEDIA_TYPES = [
        self::MEDIA_TYPE_ARTICLE,
        self::MEDIA_TYPE_IMAGE,
        self::MEDIA_TYPE_VIDEO,
        self::MEDIA_TYPE_MIXED,
        self::MEDIA_TYPE_PODCAST,
        self::MEDIA_TYPE_BOOK,
        self::MEDIA_TYPE_NEWS
    ];
}
