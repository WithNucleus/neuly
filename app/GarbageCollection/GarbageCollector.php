<?php

namespace App\GarbageCollection;

class GarbageCollector
{
    private $importCleaner = null;
    private $relationshipCleaner = null;

    public function __construct()
    {
        $this->importCleaner = new ImportCleaner();
        $this->relationshipCleaner = new RelationshipCleaner();
    }

    public function collectGarbage()
    {
        return array_merge(
            $this->relationshipCleaner->cleanRelations(),
            $this->importCleaner->cleanImports()
        );
    }
}
