<?php

namespace App\Http\Controllers\Backpack\CRUD\Operations;

use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Illuminate\Support\Arr;

trait UpdateOperationWithTouching
{
    use UpdateOperation { update as baseUpdate; }

    public function update()
    {
        $this->crud->hasAccessOrFail('update');

        //call before entry updated
        $this->touchIfRelationDataChanged();

        return $this->baseUpdate();
    }

    protected function touchIfRelationDataChanged()
    {
        $request = $this->crud->validateRequest();
        $requestArray = $this->crud->getStrippedSaveRequest();
        $nnRelationships = Arr::pluck($this->crud->getRelationFieldsWithPivot(), 'name');
        $newRelationshipsData = Arr::only($requestArray, $nnRelationships);

        $id = $request->get($this->crud->model->getKeyName());
        $entry = $this->crud->model->with($nnRelationships)->findOrFail($id);

        $oldRelationshipsData = [];

        foreach ($entry->toArray() as $key => $value) {
            if (in_array($key, $nnRelationships)) {
                $oldRelationshipsData[$key] = array_column($value, 'id');
            }
        }

        //compare
        if (count($newRelationshipsData) !== count($oldRelationshipsData)) {
            $entry->touch();

            return;
        }

        foreach ($newRelationshipsData as $key => $values) {
            if (! isset($oldRelationshipsData[$key])) {
                $entry->touch();

                return;
            }

            $oldValues = $oldRelationshipsData[$key];

            if (array_diff($values, $oldValues) !== [] || array_diff($oldValues, $values) !== []) {
                $entry->touch();

                return;
            }
        }
    }
}
