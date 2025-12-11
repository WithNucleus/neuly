<?php

namespace App\GarbageCollection\RelationshipCleaner;

use Illuminate\Support\Facades\DB;

class OAuthCleaner
{
    public function cleanOAuthRelation()
    {
        $messages = [];
        $messages[] = $this->cleanExpiredAccessTokens();
        $messages[] = $this->cleanRevokedAccessTokens();
        $messages[] = $this->cleanExpiredRefreshTokens();
        $messages[] = $this->cleanRevokedRefreshTokens();

        return $messages;
    }

    public function cleanExpiredAccessTokens()
    {
        $count = DB::table('oauth_access_tokens')
            ->where('expires_at', '<', now())
            ->where('revoked', false)
            ->count();

        DB::table('oauth_access_tokens')
            ->where('expires_at', '<', now())
            ->where('revoked', false)
            ->delete();

        return 'Cleaned '.$count.' expired OAuth Access Tokens.';
    }

    public function cleanRevokedAccessTokens()
    {
        $count = DB::table('oauth_access_tokens')
            ->where('revoked', true)
            ->count();

        DB::table('oauth_access_tokens')
            ->where('revoked', true)
            ->delete();

        return 'Cleaned '.$count.' revoked OAuth Access Tokens.';
    }

    public function cleanExpiredRefreshTokens()
    {
        $count = DB::table('oauth_refresh_tokens')
            ->where('expires_at', '<', now())
            ->where('revoked', false)
            ->count();

        DB::table('oauth_refresh_tokens')
            ->where('expires_at', '<', now())
            ->where('revoked', false)
            ->delete();

        return 'Cleaned '.$count.' expired OAuth Refresh Tokens.';
    }

    public function cleanRevokedRefreshTokens()
    {
        $count = DB::table('oauth_refresh_tokens')
            ->where('revoked', true)
            ->count();

        DB::table('oauth_refresh_tokens')
            ->where('revoked', true)
            ->delete();

        return 'Cleaned '.$count.' revoked OAuth Refresh Tokens.';
    }
}
