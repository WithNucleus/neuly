<div class="row">
    <div class="col-12">
        <p class="lead mb-1">Members</p>
        <ul class="list-group mb-2">
            <li class="list-group-item lead font-weight-bold mb-0">
                {{ $teamOwner->fullname }}<span class="text-primary font-size-small ml-2">Owner</span>
            </li>
            @foreach ($teamMembers as $member)
                @if($member->id !== $user->id)
                <li class="list-group-item lead font-weight-bold">{{ $member->fullname }}</li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
