<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\EntityHelper;
use App\Helpers\EntityMergeHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntityMergeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $entities = array_keys(EntityHelper::getEntities());

        return view('admin.entity_merge.index', compact('entities'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEntityListJson(Request $request)
    {
        $entityAlias = $request->input('entity_type');
        $entityModel = EntityHelper::getClassByAlias($entityAlias);

        if ($entityModel === false) {
            return response()->json(['status' => 'error'], 404);
        }

        $data = $entityModel::all()->map(function ($item, $key) {
            return [
                'id'   => $item->id,
                'name' => $item->name
            ];
        });

        return response()->json([
            'status' => 'ok',
            'data'   => $data
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getEntityForm(Request $request)
    {
        $entityAlias = $request->input('entity_type');
        $masterId    = $request->input('master_id');
        $secondaryId = $request->input('secondary_id');
        $entityModel = EntityHelper::getClassByAlias($entityAlias);

        if ($entityModel === false) {
            return response()->json(['status' => 'error'], 404);
        }

        $mapping         = $entityModel::getMergeMapping();
        $masterEntity    = $entityModel::findOrFail($masterId);
        $secondaryEntity = $entityModel::findOrFail($secondaryId);

        $view = view('admin.entity_merge.entity_form', compact('mapping', 'masterEntity', 'secondaryEntity'))->render();

        return response()->json([
            'status' => 'ok',
            'data'   => $view
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function merge(Request $request)
    {
        $entityAlias = $request->input('entity_type');
        $masterId    = $request->input('master_id');
        $secondaryId = $request->input('secondary_id');
        $attributes  = $request->input('attributes');
        $relations   = $request->input('relations');

        $entityModel = EntityHelper::getClassByAlias($entityAlias);

        if ($entityModel === false) {
            return redirect()->back()->with('error', 'Wrong entity type!');
        }

        $masterEntity    = $entityModel::findOrFail($masterId);
        $secondaryEntity = $entityModel::findOrFail($secondaryId);

        $masterEntity   = $this->mergeEntities($masterEntity, $secondaryEntity, $attributes, $relations);
        $successMessage = "Merged succesfully! \"{$masterEntity->name}\" was updated. \"{$secondaryEntity->name}\" was removed.";

        // delete secondaryEntity first to avoid unique fields duplicate error
        $secondaryEntity->delete();
        $masterEntity->update();

        return redirect()->back()->with('success', $successMessage);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $masterEntity
     * @param \Illuminate\Database\Eloquent\Model $secondaryEntity
     * @param array $attributes
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function mergeEntities($masterEntity, $secondaryEntity, $attributes, $relations)
    {
        foreach ($attributes as $attribute => $source) {
            if ($source === EntityMergeHelper::SOURCE_SECONDARY) {
                $masterEntity->{$attribute} = $secondaryEntity->{$attribute};
            }
        }

        foreach ($relations as $relationName => $source) {
            if ($source === EntityMergeHelper::SOURCE_SECONDARY || $source === EntityMergeHelper::SOURCE_MERGE) {

                if ($source === EntityMergeHelper::SOURCE_SECONDARY) {
                    // clear master entity relation's data to save only secondary entity relations
                    $masterEntity->{$relationName}()->detach();
                }

                $relationKeys = [];
                // add relation's data from secondary entity to master entity
                foreach ($secondaryEntity->{$relationName} as $relation) {
                    $relationKeys[] = $relation->getKey();
                }

                $masterEntity->{$relationName}()->syncWithoutDetaching($relationKeys);
            }
        }

        return $masterEntity;
    }
}
