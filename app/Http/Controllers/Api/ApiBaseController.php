<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookableListing;
use App\Models\Contracts\EntityImageContract;
use App\Models\EntityContent;
use App\Models\Job;
use Illuminate\Database\Eloquent\Collection;

class ApiBaseController extends Controller
{
    protected $hiddenFields;

    protected $allowedFields;

    protected $showEntityRouteName;

    protected function filterRequestData($requestArray)
    {
        $allowedFieldsData = array_intersect_key($requestArray, array_flip($this->allowedFields));

        return array_filter($allowedFieldsData);
    }

    protected function prepareEntityForResponse($entity)
    {
        if ($entity instanceof BookableListing) {
            $entity->url_external = $entity->url;
        }

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
            if ($relationItems instanceof Collection) {
                $relationItems->map(function ($relationItem) use ($relationName, $entityRelationsShowRoutes) {
                    if (isset($entityRelationsShowRoutes[$relationName]) && isset($relationItem->slug)) {
                        $relationItem->url = route($entityRelationsShowRoutes[$relationName], $relationItem->slug);
                        $relationItem->makeHidden('slug');
                    }

                    //Eloquent issue with morphed relation: without selecting "owner_id" no records will be retrieved
                    if ($relationItem instanceof Job) {
                        $relationItem->makeHidden('owner_id');
                    }

                    if ($relationItem instanceof EntityContent) {
                        $relationItem->makeHidden('entity_id');
                    }

                    $relationItem->makeHidden('pivot');
                });
            }
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
            'bookable-listings' => 'discover.bookable-listing.show',
        ];
    }
}
