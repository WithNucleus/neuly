<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Focus;
use Illuminate\Http\Request;

class ChoicesController extends Controller
{
    public function focusDrugs(Request $request): string
    {
        $default = explode(',', $request->input('default')) ?? [];
        $records = Focus::drugs()
            ->orderBy('name')
            ->get();

        return $this->getJsonFromModel($records, $default);
    }

    private function getJsonFromModel($records, $default = []): string
    {
        $recordsList = [];

        foreach ($records as $record) {
            $thisArray = [
                'label' => $record->name,
                'value' => $record->id
            ];

            if (in_array($record->id, $default)) {
                $thisArray['selected'] = true;
            }

            $recordsList[] = $thisArray;
        }

        return json_encode($recordsList);
    }
}
