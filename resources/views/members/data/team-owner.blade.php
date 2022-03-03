<h4 class="widget-title">{{ $team->name }}</h4>
@if($team->members->count() + $team->invitations->count() < 9)
    <div class="row">
        <div class="col-12">
            <form action="{{ route('member.team.invite') }}" method="post">
                @csrf
                <input type="hidden" name="team_id" value="{{ $team->id }}">

                <div class="input-group mb-2">
                    <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email"
                           aria-describedby="basic-addon2" required>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Invite</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endif

<div class="row">
    <div class="col-12">
        <p class="lead mb-1">Members</p>
        @if ($team->members->count() > 0)
            <ul class="list-group mb-2">
                @foreach ($team->members as $member)
                    <li class="list-group-item">
                        <p class="font-weight-bold mb-0"> {{ $member->fullname }}</p>

                        <div class="d-flex flex-wrap justify-content-between">
                            <div class="left-side font-size-small">
                                <i class="fad fa-clock"></i>
                                Joined {{ \Carbon\Carbon::parse($member->pivot->created_at)->diffForHumans() }}
                            </div>

                            <form class="right-side font-size-small d-inline-block" method="post"
                                  action="{{ route('member.team.removeMember', $member->id) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-link btn-sm ml-2 p-0 text-danger confirm-action">
                                    <i class="fad fa-trash-alt mr-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>You don't have any team members yet.</p>
        @endif
    </div>
</div>

@if($team->invitations->count() > 0)
    <div class="row">
        <div class="col-12">
            <p class="lead mb-1">Invitations</p>
            <ul class="list-group mb-2">
                @foreach($team->invitations as $invitation)
                    <li class="list-group-item">
                        <div class="d-flex flex-wrap justify-content-between">
                            <div class="left-side font-size-small">
                                To <b>{{ $invitation->email }}</b>
                                sent {{ \Carbon\Carbon::parse($invitation->created_at)->diffForHumans() }}
                            </div>

                            <form class="right-side font-size-small d-inline-block" method="post"
                                  action="{{ route('member.team.removeInvitation', $invitation->id) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-link btn-sm ml-2 p-0 text-danger confirm-action">
                                    <i class="fad fa-trash-alt mr-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
