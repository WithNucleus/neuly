<?php

namespace App\Helpers;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PagePreviewHelper
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Model $entity
     * @return array
     */
    public static function checkEntityPreview(Request $request, Model $entity)
    {
        $result = [
            'canView' => true,
            'redirectToRoute' => null,
        ];
        $visibilityCode = $request->get('preview');

        //TODO add VisibilityContract with VisibilityTrait to the entity and check instanceof VisibilityContract first
        if ($entity->visibility !== 'public') {
            if($entity->validateVisibilityCode($visibilityCode) === false) {
                $result['canView'] = false;
            }

            return $result;
        }

        if ($request->user() instanceof MustVerifyEmail && $request->user()->hasVerifiedEmail() === false) {
            $result['canView'] = false;
            $result['redirectToRoute'] = 'verification.notice';
        }

        return $result;
    }
}
