<?php

namespace App\Helpers;

class EntityMergeHelper
{
    const SOURCE_MASTER    = 'master';
    const SOURCE_SECONDARY = 'secondary';
    const SOURCE_MERGE     = 'merge';

    const TYPE_STRING   = 'string';
    const TYPE_INTEGER  = 'integer';
    const TYPE_DATE     = 'date';
    const TYPE_TEXT     = 'text';
    const TYPE_IMAGE    = 'image';
    const TYPE_RELATION = 'relation';

    const RELATION_ONE_N = 'one_n';
    const RELATION_N_N = 'n_n';

    /**
     * @param string $type
     * @return string
     */
    public static function getViewByFieldType($type)
    {
        switch ($type) {
            case self::TYPE_STRING:
                $view = 'text';
                break;
            case self::TYPE_INTEGER:
                $view = 'number';
                break;
            case self::TYPE_DATE:
                $view = 'date';
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

        return $view;
    }

    public static function makeLabelFromFieldName($name)
    {
        return ucwords(str_replace('_', ' ', $name));
    }

    /**
     * @param string $entityMergeMapping
     */
    public static function getMappingRelationValues($entityClass) {

        $relationValues = [];
        $entity = new $entityClass();
        $entityMergeMapping = $entity::getListingRequestMapping();

        $relations = array_filter($entityMergeMapping, function ($item) {
           return $item['type'] === self::TYPE_RELATION;
        });

        foreach ($relations as $relationName => $relationOptions) {
            $relationClass = $entity->$relationName()->getRelated();
            $keyName = $relationClass->getKeyName();
            $valueColumn = $relationOptions['relationField'];

            $relationValues[$relationName] = $relationClass::all()->pluck($valueColumn, $keyName);
        }

        return $relationValues;
    }

}
