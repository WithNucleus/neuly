<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\InsightRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InsightsController extends Controller
{
    public function index()
    {
        return view('discover.insights.index');
    }

    public function request()
    {
        return view('discover.insights.request');
    }

    public function saveRequest(Request $request)
    {
        if (auth()->check()) {
            $email = auth()->user()->email;
            $name  = auth()->user()->name;
        } else {
            $email = $request->input('email');
            $name  = $request->input('name');
        }

        $insightRequest = new InsightRequest();
        $insightRequest->email = $email;
        $insightRequest->name = $name;
        $insightRequest->text = $request->input('text');
        $insightRequest->save();

        Session::flash('success', 'Your request sent successfully.');

        return redirect()->route('discover.insights');
    }
}
