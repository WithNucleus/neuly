<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Passport\Client;

class UserOauthController extends Controller
{
    public function index()
    {
        $clientsConnected = [];
        $user = Auth::user();
        $userOauthTokens = $user->tokens()->get();

        foreach ($userOauthTokens as $token) {
            $clientsConnected[$token->client_id] = $token->client()->first();
        }

        return view('members.settings.oauth', compact('clientsConnected'));
    }

    /**
     * @param string $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function disconnectClient($clientId)
    {
        $client = Client::findOrFail($clientId);
        $user = Auth::user();
        $client->tokens()->where('user_id', $user->id)->delete();

        Session::flash('success', 'Your integration with app "' . $client->name . '" was removed.');

        return redirect()->route('user.settings.oauth');
    }

}
