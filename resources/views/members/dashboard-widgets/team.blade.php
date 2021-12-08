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
