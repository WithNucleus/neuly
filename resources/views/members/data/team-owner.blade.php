<h4 class="widget-title">{{ $user->ownedTeam->name }}</h4>
@if($user->ownedTeam->members->count() + $user->ownedTeam->invitations->count() < 9)
    <div class="row">
        <div class="col-12">
            <form action="{{ route('member.team.invite') }}" method="post">
                @csrf
                <input type="hidden" name="team_id" value="{{ $user->ownedTeam->id }}">
                <div class="d-flex mb-3 max-width-400">
                    <input type="email" name="email" class="form-control rounded-start-pill ps-3" placeholder="Email" aria-label="Email" required>
                    <button class="btn btn-primary rounded-end-pill pe-3" type="submit">Invite</button>
                </div>
            </form>
        </div>
    </div>
@endif

<div class="row">
    <div class="col-12">
        <p class="lead fw-bold mb-1">Members</p>
        <ul class="list-group mb-2">
            @forelse ($user->ownedTeam->members as $member)
                <li class="list-group-item">
                    <div class="d-flex align-items-center">
                        <p class="lead fw-bold mb-1 me-3">{{ $member->fullname }}</p>
                        <p class="mb-1">{{ $member->email }}</p>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between align-items-end">
                        <div class="left-side font-size-small">
                            <i class="fa-strong far fa-clock"></i>
                            Joined {{ \Carbon\Carbon::parse($member->pivot->created_at)->diffForHumans() }}
                        </div>

                        <form class="right-side font-size-small d-inline-block" method="post"
                              action="{{ route('member.team.removeMember', $member->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm rounded-0 ms-2 confirm-action">
                                Remove Member
                            </button>
                        </form>
                    </div>
                </li>
            @empty
                <li class="list-group-item">
                    You don't have any team members yet.
                </li>
            @endforelse
        </ul>
    </div>
</div>

@if($user->ownedTeam->invitations->count() > 0)
    <div class="row">
        <div class="col-12">
            <p class="lead fw-bold mb-1">Invitations</p>
            <ul class="list-group mb-2">
                @foreach($user->ownedTeam->invitations as $invitation)
                    <li class="list-group-item">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <div class="me-3">
                                <strong>{{ $invitation->email }}</strong> sent {{ \Carbon\Carbon::parse($invitation->created_at)->diffForHumans() }}
                            </div>

                            <form method="post" action="{{ route('member.team.removeInvitation', $invitation->id) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm rounded-0 ms-2 confirm-action">
                                    Delete Invite
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
