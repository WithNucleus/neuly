<?php

namespace App\Models\Traits;

use App\Helpers\EntityHelper;

trait CrudShowEntityPageButton
{
    public function getShowEntityPageButton()
    {
        $alias = EntityHelper::getAliasByClass(self::class);

        return '<a class="btn btn-sm btn-link" href="' . route("discover.$alias.show", $this->slug) . '" data-toggle="tooltip" title="Show entity page."><i class="la la-eye"></i> Show page</a>';
    }
}
