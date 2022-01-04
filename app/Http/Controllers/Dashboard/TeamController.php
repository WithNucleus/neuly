<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamInvitationRequest;
use App\Mail\TeamInvitationMail;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TeamController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $team = $user->ownedTeam()->with(['members', 'invitations'])->first();

        return view('members.team.index', compact('team'));
    }

    public function create(Request $request)
    {
        $user = auth()->user();
        $name = $request->input('name');

        Team::create([
            'owner_id' => $user->id,
            'name' => $name,
        ]);

        $user->assignRole('Team owner');

        return redirect()->back()->with('success', 'Team created!');
    }

    public function invite(TeamInvitationRequest $request)
    {
        $user = auth()->user();
        $teamId = $request->input('team_id');
        $email = $request->input('email');
        $code = bcrypt($email);
        $team = Team::findOrFail($teamId);

        TeamInvitation::create([
            'team_id' => $teamId,
            'email' => $email,
            'code' => $code,
        ]);

        Mail::to($email)->send(new TeamInvitationMail($team->name, $user->fullname, $code));

        return redirect()->back()->with('success', 'Invitation to ' . $email . ' was sent!');
    }

    // Store Note
    public function removeInvitation($invitationId)
    {
        TeamInvitation::destroy($invitationId);

        return redirect()->back()->with('success', 'Invitation was removed.');
    }

    public function removeMember($memberId)
    {
        $user = auth()->user();
        $team = $user->ownedTeam()->first();

        if ($team && $member = User::find($memberId)) {
            $team->removeMember($member);
            $member->removeRole('Team member');
        }

        return redirect()->back()->with('success', 'Member was removed.');
    }

    public function leaveTeam($teamId)
    {
        $user = auth()->user();
        $team = Team::findORFail($teamId);

        $team->removeMember($user);
        $user->removeRole('Team member');

        return redirect()->back()->with('success', 'You left the team.');
    }
}
