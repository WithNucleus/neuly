<?php
/**
 * @param boolean $show_more
 * @param boolean $shadow
 */
?>
@if ($follows->count() > 0)
    <ul class="list-group @if($shadow == true)shadow-sm @endif">
        @foreach ($follows as $follow)
            <li class="list-group-item">
                <p class="font-weight-bold mb-0">
                    <a href="{{ route('member.follow.show', ['follow' => $follow]) }}">{{ $follow->followable->name ?? $follow->followable->title }}</a>
                </p>

                <div class="d-flex flex-wrap justify-content-between">
                    <div class="left-side font-size-small @if($show_more == true) mt-1 mb-1 @endif">
                        <i class="fad fa-clock"></i> Added {{ \Carbon\Carbon::parse($follow->created_at)->diffForHumans() }}

                        <span class="ml-3 {{ $follow->email_notification ? 'text-success' : 'text-muted' }}"><i class="fad fa-bell"></i> Email notifications</span>
                        <span class="ml-3 {{ $follow->app_notification ? 'text-success' : 'text-muted'  }}"><i class="fad fa-bell"></i> Neuly notifications</span>
                    </div>

                    <div class="right-side font-size-small">
                        <a href="{{ route('member.follow.edit', $follow->id) }}" class="text-primary text-decoration-none mr-2"><i class="fad fa-edit"></i> Edit</a>
                        <a href="#" class="text-danger text-decoration-none js-unfollow-button"><i class="fad fa-trash-alt"></i> Unfollow</a>
                        <form method="post" action="{{ route('member.follow.destroy', $follow->id) }}" style="display: none;">
                            @csrf
                            @method('delete')
                        </form>
                    </div>
                </div>
            </li>
        @endforeach
        @if($show_more == true)
            <li class="list-group-item d-flex align-items-center flex-wrap justify-content-between">
                <small><a href="{{ route('member.follow.index') }}" class="text-dark text-decoration-none font-weight-bold">
                    See Full Follows List <i class="fad fa-chevron-double-right text-danger"></i>
                </a></small>
            </li>
        @endif
    </ul>
@else
    <p>You aren't following anything yet.</p>
@endif
<script>
    $(function(){
        $('.js-unfollow-button').on('click', function (e) {
            e.preventDefault();
            if (confirm("Are you sure?")) {
                $(this).siblings('form').submit();
            }
        })
    });
</script>