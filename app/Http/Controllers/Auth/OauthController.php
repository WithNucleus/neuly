<?php

namespace App\Http\Controllers\Auth;

use App\User;

class OauthController
{
    public function getUser()
    {
        $user = auth()->user();
        $userPhoto = null;

        if ($user instanceof User && $user->relatedPerson !== null) {
            $userPhoto = $user->relatedPerson->fullImageUrl;
        }

        $responseData = [
            'email' => $user->email,
            'first_name' => $user->name,
            'last_name' => $user->last_name,
            'photo' => $userPhoto,
            'roles' => $user->getRoleNames()
        ];

        return response()->json($responseData);
    }
}
