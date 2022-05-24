<?php

namespace App\Listeners;

use App\Models\OauthAccessToken;
use Laravel\Passport\Client;
use Laravel\Passport\Events\AccessTokenCreated;

class RevokeOldOauthTokens
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AccessTokenCreated  $event
     * @return void
     */
    public function handle(AccessTokenCreated $event)
    {
        $client = Client::find($event->clientId);

        $client->authCodes()
            ->where('user_id', $event->userId)
            ->delete();

        $client->tokens()
            ->where('user_id', $event->userId)
            ->where('id', '!=', $event->tokenId)
            ->delete();
    }
}
