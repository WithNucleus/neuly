<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contracts\EntityImageContract;

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

        $entity->makeHidden($this->hiddenFields);
    }
}
