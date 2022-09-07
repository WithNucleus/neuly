<div class="enterprise-team-widget-container">
    @hasanyrole('Team owner|Team member')
        @role('Team owner')
            @include('members.data.team-owner')
        @else
            @include('members.data.team-member')
        @endrole
    @else
        <h2 class="widget-title">Create Your Team</h2>
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
    @endhasanyrole

</div>
