<?php

use App\Models\EmailPreference;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        $users = \App\User::all();

        foreach($users as $user) {
            EmailPreference::create([
                'email' => $user->email,
                'user_id' => $user->id,
                'marketing' => 1,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]);
        }
    }

    public function down()
    {
        EmailPreference::truncate();
    }
};
