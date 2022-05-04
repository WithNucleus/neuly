<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contracts\EntityImageContract;
use App\Models\Job;

class ApiBaseController extends Controller
{
    protected $hiddenFields;

    protected $allowedFields;

    protected $showEntityRouteName;

    protected function filterRequestData($requestArray)
    {
        return array_intersect_key($requestArray, array_flip($this->allowedFields));
    }

    protected function prepareEntityForResponse($entity)
    {
        if (isset($entity->slug)) {
            $entity->url = route($this->showEntityRouteName, $entity->slug);
        }

        if ($entity instanceof EntityImageContract) {
            $entity->imageUrl = $entity->entityImageUrl ? url($entity->entityImageUrl) : null;
        }

        if ($entity instanceof Job) {
            $entity->organization_name = $entity->ownerName;
            $entity->organization_url = $entity->ownerShowUrl;
        }

        $entity->makeHidden($this->hiddenFields);
    }

    protected function prepareEntityRelationsData($entity)
    {
        $entityRelationsShowRoutes = $this->getRelatedEntitiesShowRoutes();

        foreach ($entity->getRelations() as $relationName => $relationItems) {
            $relationItems->map(function ($relationItem) use ($relationName, $entityRelationsShowRoutes) {
                if (isset($entityRelationsShowRoutes[$relationName]) && isset($relationItem->slug)) {
                    $relationItem->url = route($entityRelationsShowRoutes[$relationName], $relationItem->slug);
                    $relationItem->makeHidden('slug');
                }

                //Eloquent issue with morphed relation: without selecting "owner_id" no records will be retrieved
                if ($relationItem instanceof Job) {
                    $relationItem->makeHidden('owner_id');
                }

                $relationItem->makeHidden('pivot');
            });
        }
    }

    protected function getRelatedEntitiesShowRoutes()
    {
        return [
            'companies' => 'discover.organizations.show',
            'people' => 'discover.people.show',
            'investors' => 'discover.investors.show',
            'research' => 'discover.research.show',
            'events' => 'discover.events.show',
            'jobs' => 'discover.jobs.show',
            'clinicaltrials' => 'discover.clinicaltrials.show',
        ];
    }
}
