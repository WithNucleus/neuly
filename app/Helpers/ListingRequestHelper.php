<?php

namespace App\Helpers;

use App\Helpers\Entity\FieldsMapping;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\EventRequest;
use App\Http\Requests\FocusRequest;
use App\Http\Requests\InvestorRequest;
use App\Http\Requests\JobRequest;
use App\Http\Requests\LocationRequest;
use App\Http\Requests\PersonRequest;
use App\Http\Requests\ResearchRequest;
use App\Models\Clinicaltrial;
use App\Models\Company;
use App\Models\Course;
use App\Models\Event;
use App\Models\Focus;
use App\Models\Investor;
use App\Models\Job;
use App\Models\Location;
use App\Models\Person;
use App\Models\Research;
use Carbon\Carbon;

class ListingRequestHelper
{
    const SOURCE_ORIGINAL = 'original';
    const SOURCE_REQUEST = 'request';

    /**
     * @return array
     */
    public static function getAllowedEntities()
    {
        return [
            'event' => Event::class,
            'investor' => Investor::class,
            'job' => Job::class,
            'organization' => Company::class,
            'person' => Person::class,
            'location' => Location::class,
            'focus' => Focus::class,
            'research' => Research::class,
            'clinicaltrial' => Clinicaltrial::class,
            'course' => Course::class,
        ];
    }

    /**
     * @param string $type
     * @return string
     * @throws \Exception
     */
    public static function getEntityClassByType($type)
    {
        $entities = self::getAllowedEntities();

        if (! isset($entities[$type])) {
            throw new \Exception('Wrong entity type!');
        }

        return $entities[$type];
    }

    /**
     * @param string $entityClass
     * @return string
     * @throws \Exception
     */
    public static function getEntityTypeByClass($entityClass)
    {
        $type = array_search($entityClass, self::getAllowedEntities());

        if (! $type) {
            throw new \Exception('Wrong entity class!');
        }

        return $type;
    }

    /**
     * @param array $options
     * @return string
     */
    public static function getFieldViewByMappingOptions($options)
    {
        $type = $options['type'];
        $morphableRelationTypes = [
            FieldsMapping::RELATION_ONE_ONE_MORPHABLE,
            FieldsMapping::RELATION_ONE_N_MORPHABLE,
            FieldsMapping::RELATION_N_N_MORPHABLE,
        ];

        switch ($type) {
            case FieldsMapping::TYPE_DATE:
                return 'date';
            case FieldsMapping::TYPE_ENUM:
                return 'select';
            case FieldsMapping::TYPE_IMAGE:
                return 'image';
            case FieldsMapping::TYPE_INTEGER:
                return 'number';
            case FieldsMapping::TYPE_STRING:
                return 'text';
            case FieldsMapping::TYPE_TEXT:
                return 'textarea';
            case FieldsMapping::TYPE_TEXT_EDITOR:
                return 'textarea_editor';
            case FieldsMapping::TYPE_RELATION:
                return in_array($options['relation'], $morphableRelationTypes) ? 'relation_morphable' : 'relation';
            default:
                return 'error';
        }
    }

    /**
     * @param string $entityClass
     * @param int|null $toUpdateEntityId
     * @return array
     * @throws \Exception
     */
    public static function getRulesByEntityClass($entityClass, $toUpdateEntityId = null)
    {
        $allowedRequestsArray = [
            Event::class => EventRequest::class,
            Investor::class => InvestorRequest::class,
            Job::class => JobRequest::class,
            Company::class => CompanyRequest::class,
            Person::class => PersonRequest::class,
            Location::class => LocationRequest::class,
            Focus::class => FocusRequest::class,
            Research::class => ResearchRequest::class,
            Course::class => CourseRequest::class,
        ];

        if (! isset($allowedRequestsArray[$entityClass])) {
            throw new \Exception('Request class for entity "'.$entityClass.'" not found!');
        }

        $requestClass =  $allowedRequestsArray[$entityClass];
        $rules = (new $requestClass)->rules();

        //modify rules array for Job entity to handle morphable relation for Listing Request form
        if ($requestClass === JobRequest::class) {
            unset($rules['owner_id'], $rules['owner_type']);

            $rules['owner.id'] = 'required';
            $rules['owner.type'] = 'required';
        }

        //check unique 'name' for update action using current entity 'id'
        if ($requestClass === CompanyRequest::class && $toUpdateEntityId !== null) {
            $rules['name'] = 'required|max:255|unique:companies,name,' . $toUpdateEntityId;
        }

        if ($toUpdateEntityId === null) {
            $rules['slug'] = 'required|min:3|max:255|unique:'.$entityClass;
        } else {
            unset($rules['slug']);
        }

        return $rules;
    }

    /**
     * @param string $entityMergeMapping
     * @return array
     */
    public static function getEntityRelationValuesByType($type)
    {
        $relationValues = [];
        $entityClass = self::getEntityClassByType($type);
        $entityFieldsMapping = $entityClass::getListingRequestMapping();
        $entity = new $entityClass();

        $relations = array_filter($entityFieldsMapping, function ($item) {
            return $item['type'] === FieldsMapping::TYPE_RELATION;
        });

        foreach ($relations as $relationName => $relationOptions) {
            $relatedClass = $entity->$relationName()->getRelated();
            $keyName = $relatedClass->getKeyName();
            $valueColumn = $relationOptions['relationField'];

            $relationValues[$relationName] = $relatedClass::all()->pluck($valueColumn, $keyName);
        }

        return $relationValues;
    }

    /**
     * @param object $originalEntity
     * @param object $requestData
     * @param string $field
     * @param array $options
     * @return bool
     */
    public static function isEntitiesFieldDifferent($originalEntity, $requestData, $field, $options)
    {
        if (! isset($requestData->{$field})) {
            $requestData->{$field} = null;
        }

        switch ($options['type']) {
            case FieldsMapping::TYPE_RELATION:
                if ($options['relation'] === FieldsMapping::RELATION_ONE_ONE_MORPHABLE) {
                    $originalValue = $originalEntity->{$options['morphableFieldId']};
                    $requestValue = isset($requestData->{$field}->id) ? $requestData->{$field}->id : null;

                    return $originalValue != $requestValue;
                } else {
                    $originalValues = $originalEntity->{$field}->pluck('id')->toArray();
                    $requestValues = $requestData->{$field} ? $requestData->{$field} : [];

                    $difference = array_merge(
                        array_diff($originalValues, $requestValues),
                        array_diff($requestValues, $originalValues)
                    );

                    return count($difference) > 0;
                }

            case FieldsMapping::TYPE_IMAGE:
                return $requestData->{$field} !== null ? $originalEntity->{$field} != $requestData->{$field} : false;

            case FieldsMapping::TYPE_DATE:
                $originalValue = $originalEntity->{$field};
                $requestValue = $requestData->{$field} !== null ? Carbon::create($requestData->{$field}) : $requestData->{$field};

                return $originalValue != $requestValue;

            default:
                return $originalEntity->{$field} != $requestData->{$field};
        }
    }
}
