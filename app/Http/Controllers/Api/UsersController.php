<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController
{
    public function show($userId)
    {
        $user = User::findOrFail($userId);

        return response()->json([
            'status' => 'Success',
            'data' => $this->prepareUserResponseData($user),
        ]);
    }

    public function search(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
        ])->validate();

        $email = $request->input('email');

        try {
            $user = User::where('email', $email)->firstOrFail();
        } catch (\Throwable $throwable) {
            return response()->json([
                'status' => 'Error',
                'message' => 'User not found.',
            ], 404);
        }

        return response()->json([
            'status' => 'Success',
            'data' => $this->prepareUserResponseData($user),
        ]);
    }

    public function create(UserRequest $request)
    {
        $data = $request->validated();

        try {
            $user = User::create([
                'name' => $data['name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'email_verified_at' => Carbon::now(),
            ])->assignRole($data['role']);
        } catch (\Throwable $throwable) {
            return response()->json(['status' => 'Error', 'message' => $throwable->getMessage()]);
        }

        return response()->json([
            'status' => 'Success',
            'message' => 'User created.',
            'data' => $this->prepareUserResponseData($user),
        ]);
    }

    public function update(UserRequest $request, $userId)
    {
        $user = User::findOrFail($userId);
        $data = $request->validated();

        try {
            $user->update($data);
        } catch (\Throwable $throwable) {
            return response()->json(['status' => 'Error', 'message' => $throwable->getMessage()]);
        }

        return response()->json([
            'status' => 'Success',
            'message' => 'User updated.',
            'data' => $this->prepareUserResponseData($user),
        ]);
    }

    private function prepareUserResponseData(User $user)
    {
        $hiddenFields = [
            'member_url',
            'email_verified_at',
            'password',
            'remember_token',
            'created_at',
            'updated_at',
            'dashboard_widgets_order',
        ];

        $user->makeHidden($hiddenFields);
        $responseData = $user->toArray();
        $responseData['roles'] = $user->getRoleNames();

        return $responseData;
    }
}
