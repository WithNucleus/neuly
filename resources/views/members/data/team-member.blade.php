<div class="row">
    <div class="col-12">
        <div class="d-flex flex-wrap justify-content-between">
            <div class="left-side">
                <h4>{{ $team->name }}</h4>
            </div>

            <form class="right-side font-size-small d-inline-block" method="post"
                  action="{{ route('member.team.leave', $team->id) }}">
                @csrf
                <button type="submit" class="btn btn-link btn-sm ml-2 p-0 text-danger confirm-action">
                    <i class="fad fa-trash-alt"></i> Leave
                </button>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <p class="lead mb-1">Members</p>
        <ul class="list-group mb-2">
            <li class="list-group-item lead font-weight-bold mb-0">
                {{ $team->owner->fullname }}<span class="text-primary font-size-small ml-2">Owner</span>
            </li>
            @foreach ($team->members as $member)
                <li class="list-group-item lead font-weight-bold">
                    {{ $member->fullname }} @if($member->id === $user->id)<span class="font-size-small ml-2">You</span>@endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
