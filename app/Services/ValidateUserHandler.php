<?php


namespace App\Services;


use Illuminate\Support\Facades\Hash;

class ValidateUserHandler
{
    public function execute($enteredPassword, $userPassword)
    {
        return Hash::check($enteredPassword, $userPassword);
    }
}
