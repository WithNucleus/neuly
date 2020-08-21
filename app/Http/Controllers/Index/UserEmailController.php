<?php

namespace App\Http\Controllers\Index;
 use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeMailRequest;
use App\Mail\ChangeMailAddressMail;
use App\Mail\ResetChangedMailAddressMail;
 use App\Models\EmailReset;
 use App\Services\ValidateUserHandler;
use App\User;
 use Carbon\Carbon;
 use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
 use Illuminate\Support\Str;

 class UserEmailController extends Controller
{
    public function index(Request $request)
    {
        return view('members.settings.email');
    }

    public function update(ChangeMailRequest $request, ValidateUserHandler $validateUserHandler)
    {
        $user = Auth::user();
        $password = $request->input('password');

        if (!$validateUserHandler->execute($password, $user->password)) {
            Session::flash('error', 'Request validation failed. Please try again.');
            return redirect(route('user.settings.email'));
        }

        $emailReset = new EmailReset();
        $emailReset->email = $user->email;
        $emailReset->user_id = $user->id;
        $emailReset->token = Str::uuid();
        $emailReset->valid_till = Carbon::now()->addDay(30);
        $emailReset->save();


        $newMail = $request->input('new_email');
        $link = route('user.retake', ['token' => $emailReset->token]);

        Mail::to($user)->send(new ResetChangedMailAddressMail($user->name, $newMail, $link));

        $user->email = $newMail;
        $user->save();

        Mail::to($user)->send(new ChangeMailAddressMail($user->name));

        Session::flash('success', 'Your email has been changed successfully.');

        return redirect(route('user.settings.email'));
    }
}
