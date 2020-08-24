<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Http\Requests\ChangeUserSettingsRequest;
use App\Services\ValidateUserHandler;
use Illuminate\Support\Facades\Session;
use Validator;

class UserProfileController extends Controller
{
    public function index(Request $request)
    {
    	$user = User::find(Auth::user()->id);

        return view('members.settings.profile', compact('user'));
    }

    public function update(ChangeUserSettingsRequest $request)
    {
        $user = Auth::user();
        // $password = $request->input('password');

        // if (!$validateUserHandler->execute($password, $user->password)) {
        //     Session::flash('error', 'Request validation failed. Please try again.');
        //     return redirect(route('user.settings'));
        // }

        $newName = $request->input('new_name');
        $lastName = $request->input('last_name');

        $user->name = $newName;
        $user->last_name = $lastName;
        $user->member_url = $request->input('member_url');
        $user->save();

        Session::flash('success', 'Your profile is updated.');

        return redirect(route('user.settings'));
    }

    // Check Slug via ajax
    public function checkMemberUrl(Request $request) {

        $validator = Validator::make($request->all(), [
            'member_url' => 'nullable|max:25|alpha_dash|unique:users,member_url,' . Auth::user()->id,
        ]);

        if ($validator->passes()) {

            return response()->json(['success' => 'Member URL is good']);
        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }
}
