<?php

namespace App\Helpers;

use App\Models\Company;
use App\Models\Person;
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

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Model $entity
     * @return array
     */
    public static function checkListingRequestPreview(Request $request)
    {
        $result = [
            'canView' => true,
            'redirectToRoute' => null,
        ];

        if ($request->has('preview_request')) {
            $previewRequest = [
                'type' => $request->input('entity_type'),
                'id' => $request->input('to_update_id'),
                'code' => $request->input('preview_request')
            ];

            view()->share('previewRequest', $previewRequest);

            if (self::checkEntityPreviewCode($previewRequest) === true) {
                return $result;
            }
        }

        if ($request->user() instanceof MustVerifyEmail && $request->user()->hasVerifiedEmail() === false) {
            $result['canView'] = false;
            $result['redirectToRoute'] = 'verification.notice';
        }

        return $result;
    }

    private static function checkEntityPreviewCode($previewRequest): bool
    {
        $allowedEntities = [
            'organization' => Company::class,
            'person' => Person::class,
        ];

        if (array_key_exists($previewRequest['type'], $allowedEntities)) {
            $model = $allowedEntities[$previewRequest['type']];
            $entity = $model::findOrFail($previewRequest['id']);

            if ($entity->visibility_code === $previewRequest['code']) {
                return true;
            }
        }

        return false;
    }
}
