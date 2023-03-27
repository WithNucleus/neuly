<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamInvitation;
use App\User;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function show()
    {
        $code = request()->get('code');
        $invitation = TeamInvitation::where('code', $code)->firstOrFail();
        $existedUser = User::where('email', $invitation->email)->first();

        if ($existedUser === null) {
            return redirect()->route('register', ['code' => $code]);
        }

        $team = Team::findOrFail($invitation->team_id);

        return view('members.team.show-invitation', [
            'team' => $team,
            'invitationId' => $invitation->id,
            'userId' => $existedUser->id,
        ]);
    }

    public function accept(Request $request)
    {
        $teamId = $request->input('team_id');
        $userId = $request->input('user_id');
        $invitationId = $request->input('invitation_id');

        $team = Team::findOrFail($teamId);
        $user = User::findOrFail($userId);

        $team->addMember($user);
        TeamInvitation::destroy($invitationId);

        return redirect()->route('member.dashboard')->with('success', 'Invitation accepted!');
    }
}
