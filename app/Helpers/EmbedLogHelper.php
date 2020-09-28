<?php

namespace App\Helpers;

use App\Models\LogEmbed;
use Illuminate\Http\Request;

class EmbedLogHelper
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Model $entity
     * @return void
     */
    public static function add(Request $request, $entity)
    {
        if ($request->has('referer') === false) {
            return;
        }

        $log = new LogEmbed();
        $log->entity_id   = $entity->getKey();
        $log->entity_type = get_class($entity);
        $log->referer_url = $request->get('referer');
        $log->save();
    }
}
