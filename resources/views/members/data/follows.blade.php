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
                <div class="d-flex flex-wrap justify-content-between lead fw-bold">
                    <a href="{{ route('member.follow.show', ['follow' => $follow]) }}">{{ $follow->followable->name }}</a>
                    @if($show_list_name == true)
                        <a href="{{ route('member.follow-lists.show', $follow->list->slug) }}" class="text-decoration-none text-body-emphasis">
                            <i class="fa-strong far fa-list-alt"></i> {{ $follow->list->name }}
                        </a>
                    @endif
                </div>

                @if($show_more == false && (!isset($public_list) || $public_list == false))
                    <div class="mt-2 text-body-secondary">{{ $follow->notes }}</div>
                @endif

                <div class="d-flex align-items-end flex-wrap justify-content-between widget-expandable-details">
                    @if(!isset($public_list) || $public_list == false)
                    <div class="mt-2 font-size-small widget-expandable-details">
                        <i class="fa-strong far fa-clock"></i> Added {{ \Carbon\Carbon::parse($follow->created_at)->diffForHumans() }}
                        <span class="ms-3 {{ $follow->email_notification ? 'text-success' : 'text-muted' }}"><i class="fa-strong far fa-bell"></i> Email notifications</span>
                        <span class="ms-3 {{ $follow->app_notification ? 'text-success' : 'text-muted'  }}"><i class="fa-strong far fa-bell"></i> Neuly notifications</span>
                    </div>
                    @endif

                    @if($show_action_items == true)
                        <div class="mt-2 font-size-small">
                            <a href="{{ route('member.follow.edit', $follow->id) }}" class="btn btn-sm btn-primary me-2">
                                <i class="fa-strong far fa-edit"></i>
                                <span>Edit</span>
                            </a>
                            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                               data-target="#unfollow-modal-{{$follow->followable_id}}">
                                <i class="fa-strong far fa-trash-alt"></i>
                                <span>Unfollow</span>
                            </a>

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
            <li class="list-group-item">
                <a href="{{ route('member.follow.index') }}" class="text-small text-body-emphasis text-uppercase text-decoration-none fw-bold">
                    <span class="me-1">See All Follows</span>
                    <i class="fa-strong far fa-chevron-double-right text-danger"></i>
                </a>
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
