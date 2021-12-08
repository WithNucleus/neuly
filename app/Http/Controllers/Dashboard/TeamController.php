<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamInvitationRequest;
use App\Mail\TeamInvitationMail;
use App\Models\TeamInvitation;
use App\User;
use Illuminate\Support\Facades\Mail;

class TeamController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $teamMembers = $user->teamMembers()->get();
        $invitations = $user->teamInvitations()->get();

        return view('members.team.index', compact('teamMembers', 'invitations'));
    }

    public function invite(TeamInvitationRequest $request)
    {
        $user = auth()->user();
        $email = $request->input('email');
        $code = bcrypt($email);

        TeamInvitation::create([
            'user_id' => $user->id,
            'email' => $email,
            'code' => $code,
        ]);

        Mail::to($email)->send(new TeamInvitationMail($user->fullname, $code));

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

        if ($member = User::find($memberId)) {
            $user->removeMember($member);
            $member->removeRole('Team member');
        }

        return redirect()->back()->with('success', 'Member was removed.');
    }
}
