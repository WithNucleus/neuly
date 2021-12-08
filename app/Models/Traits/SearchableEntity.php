<?php

namespace App\Models\Traits;

use App\Models\Contracts\EntityImageContract;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Laravel\Scout\Searchable;

trait SearchableEntity {

    use Searchable;

    /**
     * Creates a searchable array of the entity and its related data for Laravel Scout + Algolia
     */
    public function toSearchableArray(): array
    {
        $array = $this->transform($this->toArray());

        /**
         * Rename Fields
         *  @requires $currentName => $newName
         *  e.g. job_title => name
         */
        if (property_exists($this, 'searchableRenamedFields')) {
            foreach ($this->searchableRenamedFields as $currentName => $newName) {
                $array[$newName] = $this->{$currentName};
                unset($array[$currentName]);
            }
        }

        /**
         * Relationships
         *  @requires $relationName => $fieldName
         *  e.g. companies => name
         */
        if (property_exists($this, 'searchableRelationships')) {
            foreach ($this->searchableRelationships as $relationName => $fieldName) {
                if ($relationName === 'locations') {
                    $array[$relationName] = $this->{$relationName}->map(function ($data) {
                        return [
                            'name' => $data['name'],
                            'city' => $data['city'],
                            'region' => $data['region'],
                            'country' => $data['country']
                        ];
                    })->toArray();
                } else {
                    $array[$relationName] = $this->{$relationName}->map(function ($data) use ($fieldName) {
                        return $data[$fieldName];
                    })->toArray();
                }
            }
        }

        /**
         * Format date fields to YYYY-MM-DD
         * @requires $dateField
         */
        if (property_exists($this, 'searchableDateFields')) {
            foreach ($this->searchableDateFields as $dateField) {
                if ($this->{$dateField} != '') {
                    $array[$dateField . '_pretty'] = Carbon::parse($this->{$dateField})->format('Y-m-d');
                }
            }
        }

        /**
         * Morphs
         *  @requires $relationName => $fieldName
         *  e.g. owner => name for Jobs
         */
        if (property_exists($this, 'searchableMorphs')) {
            foreach ($this->searchableMorphs as $relationName => $fieldName) {
                $array[$relationName] = $this->{$relationName}->{$fieldName};
            }
        }

        /**
         * Add Image if Has EntityImageContract
         */
        if ($this instanceof EntityImageContract) {
            $array[self::$imageAttribute] = config('scout.image_url_prefix') . $this->entityImageUrl;
        }

        /**
         * Fields to remove before sending
         */
        if (property_exists($this, 'searchableSkippedFields')) {
            $array = Arr::except($array, $this->searchableSkippedFields);
        }

        return $array;
    }
}
