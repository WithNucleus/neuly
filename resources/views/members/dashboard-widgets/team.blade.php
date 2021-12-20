@hasanyrole('Team owner|Team member')
    @role('Team owner')
        <h1 class="h2">
            <a href="{{ route('member.team.index') }}" class="text-dark">
                <i class="fad fa-users text-secondary mr-2"></i>Team
            </a>
        </h1>
        <div class="p-4 bg-white shadow-sm">
            @include('members.data.team-owner')
        </div>
    @else
        <h1 class="h2"><i class="fad fa-users text-secondary mr-2"></i>Team</h1>
        <div class="p-4 bg-white shadow-sm">
            @include('members.data.team-member')
        </div>
    @endrole
@else
    <h1 class="h2"><i class="fad fa-users text-secondary mr-2"></i>Team</h1>
    <div class="p-4 bg-white shadow-sm">
        <p class="lead mb-1">Create your team</p>
        <form action="{{ route('member.team.create') }}" method="post">
            @csrf
            <div class="input-group mb-2">
                <input type="text" name="name" class="form-control" placeholder="Team Name" aria-label="Name"
                       aria-describedby="basic-addon2" required>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>
            </div>
        </form>
    </div>
@endhasanyrole
