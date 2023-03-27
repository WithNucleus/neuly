<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Mail\RetakeAccountMail;
use App\Models\EmailReset;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserRetakeController extends Controller
{
    public function index(Request $request, string $token)
    {
        $emailReset = EmailReset::where('token', '=', $token)
                                ->whereNotNull('valid_till')
                                ->first();

        if ($emailReset === null) {
            return 'Oops - it looks like this link has already been used. If you are still having trouble, please email support@neuly.com.';
        }

        if ($emailReset->valid_till < Carbon::now()) {
            return 'This link has expired. If you still need to restore your email, please email support@neuly.com.';
        }

        $user = User::find($emailReset->user_id);

        $user->email = $emailReset->email;
        $user->save();

        $emailReset->valid_till = null;
        $emailReset->save();

        Mail::to($user)->send(new RetakeAccountMail($user->name));

        return redirect(route('login'));
    }
}
