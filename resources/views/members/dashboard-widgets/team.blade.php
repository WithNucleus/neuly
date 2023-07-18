@hasanyrole('Team owner|Team member')
    @role('Team owner')
        <h1 class="h2">
            <a href="{{ route('member.team.index') }}" class="text-decoration-none">
                <i class="fa-sharp fa-solid fa-users text-accent"></i>
                <span>Team</span>
            </a>
        </h1>
        <div>
            @include('members.data.team-owner')
        </div>
    @else
        <h1 class="h2">
            <i class="fa-sharp fa-solid fa-users text-accent mr-2"></i>
            <span>Team</span>
        </h1>
        <div class="p-4 bg-white shadow-sm">
            @include('members.data.team-member')
        </div>
    @endrole
@else
    <h1 class="h2">
        <i class="fa-sharp fa-solid fa-users text-accent"></i>
        <span>Team</span>
    </h1>
    <div>
        <p class="lead mb-1">Create your team</p>
        <form action="{{ route('member.team.create') }}" method="post">
            @csrf
            <div class="d-flex mb-2 max-width-400">
                <input type="text" name="name" class="form-control me-1" placeholder="Team Name" aria-label="Team Name" required>
                <button class="btn btn-primary rounded-0" type="submit">Create</button>
            </div>
        </form>
    </div>
@endhasanyrole
