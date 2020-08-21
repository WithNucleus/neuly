<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Mail\ChangePasswordMail;
use App\Services\ValidateUserHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserPasswordController extends Controller
{
    public function index(Request $request)
    {
        return view('members.settings.password');
    }

    public function update(ChangePasswordRequest $request, ValidateUserHandler $validateUserHandler)
    {
        $user = Auth::user();
        $password = $request->input('password');

        if (!$validateUserHandler->execute($password, $user->password)) {
            Session::flash('error', 'Request validation failed. Please try again.');
            return redirect(route('user.settings.password'));
        }

        $newPassword = $request->input('new_password');
        $user->password = Hash::make($newPassword);
        $user->save();

        Mail::to($user)->send(new ChangePasswordMail($user->name));

        Session::flash('success', 'Your password has be changed successfully.');

        return redirect(route('user.settings.password'));
    }
}
