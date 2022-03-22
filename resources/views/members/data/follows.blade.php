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
                <div class="d-flex flex-wrap justify-content-between">
                    <a href="{{ route('member.follow.show', ['follow' => $follow]) }}" class="left-side font-weight-bold">{{ $follow->followable->name }}</a>
                    @if($show_list_name == true)
                        <a href="{{ route('member.follow-lists.show', $follow->list->slug) }}" class="right-side text-decoration-none text-dark font-weight-bold">
                            <i class="fad fa-list-alt"></i> {{ $follow->list->name }}
                        </a>
                    @endif
                </div>

                @if($show_more == false && (!isset($public_list) || $public_list == false))
                    <div class="mt-1 mb-1">
                        <small>{{ $follow->notes }}</small>
                    </div>
                @endif

                <div class="d-flex flex-wrap justify-content-between widget-expandable-details">
                    @if(!isset($public_list) || $public_list == false)
                    <div class="left-side font-size-small widget-expandable-details">
                            <i class="fad fa-clock"></i> Added {{ \Carbon\Carbon::parse($follow->created_at)->diffForHumans() }}
                            <span class="ml-3 {{ $follow->email_notification ? 'text-success' : 'text-muted' }}"><i class="fad fa-bell"></i> Email notifications</span>
                            <span class="ml-3 {{ $follow->app_notification ? 'text-success' : 'text-muted'  }}"><i class="fad fa-bell"></i> Neuly notifications</span>
                    </div>
                    @endif

                    @if($show_action_items == true)
                    <div class="right-side font-size-small">
                        <a href="{{ route('member.follow.edit', $follow->id) }}" class="text-primary text-decoration-none mr-2"><i class="fad fa-edit"></i> Edit</a>
                        <a href="#" class="text-danger text-decoration-none" data-toggle="modal"
                           data-target="#unfollow-modal-{{$follow->followable_id}}"><i class="fad fa-trash-alt"></i> Unfollow</a>

                        @include('members.follow.modals.unfollow', [
                            'followable_type' => $follow->followable_type,
                            'followable_id' => $follow->followable_id,
                            'name' => $follow->followable->name
                        ])
                    </div>
                    @endif
                </div>
            </li>
        @endforeach

        @if($show_more == true)
            <li class="list-group-item d-flex align-items-center flex-wrap justify-content-between">
                <small><a href="{{ route('member.follow.index') }}" class="text-dark text-decoration-none font-weight-bold">
                    See All Follows <i class="fad fa-chevron-double-right text-danger"></i>
                </a></small>
            </li>
        @endif
    </ul>
@else
    @if(isset($public_list) && $public_list == true)
        <p>This list doesn't have anything in it yet.</p>
    @else
        <p>You aren't following anything yet. You can save everything in Neuly to your follow lists - watch out for this icon <i class="far fa-star text-primary"></i> to follow items.</p>
    @endif
@endif
