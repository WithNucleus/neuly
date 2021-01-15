<?php

namespace App\Helpers;

use App\Helpers\Entity\FieldsMapping;

class EntityMergeHelper
{
    const SOURCE_MASTER    = 'master';
    const SOURCE_SECONDARY = 'secondary';
    const SOURCE_MERGE     = 'merge';

    /**
     * @param string $type
     * @return string
     */
    public static function getViewByFieldType($type)
    {
        switch ($type) {
            case FieldsMapping::TYPE_DATE:
            case FieldsMapping::TYPE_ENUM:
            case FieldsMapping::TYPE_INTEGER:
            case FieldsMapping::TYPE_STRING:
                $view = 'text';
                break;
            case FieldsMapping::TYPE_TEXT:
                $view = 'textarea';
                break;
            case FieldsMapping::TYPE_IMAGE:
                $view = 'image';
                break;
            case FieldsMapping::TYPE_RELATION:
                $view = 'relation';
                break;
            default:
                $view = 'error';
                break;
        }

        return $view;
    }

}
