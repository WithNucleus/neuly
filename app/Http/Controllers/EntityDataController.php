<?php

namespace App\Http\Controllers;

use App\Helpers\EntityHelper;
use Illuminate\Http\Response;

class EntityDataController extends Controller
{
    /**
     * @param string $alias
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEntitiesListByAlias($alias)
    {
        $entityClass = EntityHelper::getClassByAlias($alias);

        if ($entityClass === false) {
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_NOT_FOUND);
        }

        $data = $entityClass::all()->map(function ($item, $key) {
            return [
                'id' => $item->id,
                'name' => $item->name,
            ];
        });

        return response()->json([
            'status' => 'ok',
            'data' => $data,
        ]);
    }
}
