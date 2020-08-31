<?php

namespace App\Helpers;

class EntityMergeHelper
{
    const SOURCE_MASTER    = 'master';
    const SOURCE_SECONDARY = 'secondary';

    const TYPE_STRING   = 'string';
    const TYPE_TEXT     = 'text';
    const TYPE_IMAGE    = 'image';
    const TYPE_RELATION = 'relation';

    /**
     * @param string $type
     * @return string
     */
    public static function getFieldViewPathByType($type)
    {
        switch ($type) {
            case self::TYPE_STRING:
                $view = 'text';
                break;
            case self::TYPE_TEXT:
                $view = 'textarea';
                break;
            case self::TYPE_IMAGE:
                $view = 'image';
                break;
            case self::TYPE_RELATION:
                $view = 'relation';
                break;
            default:
                $view = 'error';
                break;
        }

        return 'admin.entity_merge.fields.' . $view;
    }

    public static function makeLabelFromFieldName($name)
    {
        return ucwords(str_replace('_', ' ', $name));
    }

}
