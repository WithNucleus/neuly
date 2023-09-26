<?php

namespace App\Models\Contracts;

interface CrmActionsContract {

    /**
     * REQUIRED CONSTANTS:
     *   TYPES
     *   STATUSES
     */

    public function getStatusColorAttribute();
    public static function crmActionItems();
}
