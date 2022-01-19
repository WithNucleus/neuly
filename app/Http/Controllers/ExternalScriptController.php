<?php

namespace App\Http\Controllers;

use App\Models\EmbeddableSearchWidget;

class ExternalScriptController extends Controller
{
    public function getSearchModalTemplate($code)
    {
        $widget = EmbeddableSearchWidget::where('code', $code)->first();

        if (!$widget) {
            return response()->json(['message' => 'Template not found'], 404);
        }

        list($activeTab) = $widget->tabs;

        return response()->view('external-scripts.embed-search.modal', [
            'widget' => $widget,
            'activeTab' => $activeTab,
        ]);
    }
}
