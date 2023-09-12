<h1 class="h2">
    <i class="fa-sharp fa-solid fa-users text-accent"></i>
    <span>Team</span>
</h1>

@foreach($user->teams as $team)
    <div class="border p-3 mb-4">
        @include('members.data.team-member')
    </div>
@endforeach

@if($user->ownedTeam)
    <div class="border p-3 mb-4">
        @include('members.data.team-owner')
    </div>
@else
    <div class="border p-3 mb-4">
        <p class="lead mb-1">Create your team</p>
        <form action="{{ route('member.team.create') }}" method="post">
            @csrf
            <div class="d-flex mb-2 max-width-400">
                <input type="text" name="name" class="form-control me-1" placeholder="Team Name" aria-label="Team Name" required>
                <button class="btn btn-primary rounded-0" type="submit">Create</button>
            </div>
        </form>
    </div>
@endif
