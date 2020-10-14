<?php

namespace App\GarbageCollection;

use App\GarbageCollection\ImportCleaner\FailureCleaner;

class ImportCleaner
{
    private $failureCleaner = null;

    public function __construct()
    {
        $this->failureCleaner = new FailureCleaner();
    }

    public function cleanImports()
    {
        $messages = [$this->failureCleaner->cleanOldFailures()];

        return $messages;
    }
}
