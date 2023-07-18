<?php
/**
 * @param boolean $shadow
 * @param boolean $show_more
 */
?>

@if ($lists->count() > 0)
    <ul class="list-group @if($shadow == true)shadow-sm @endif">
        @foreach ($lists as $list)
            <li class="list-group-item d-flex justify-content-between">
                <div class="left-side">
                    <a href="{{ route('member.follow-lists.show', $list->slug) }}" class="lead fw-bold">{{ $list->name }}</a>

                    @if ($list->followItems->count() > 0)
                        <span class="font-size-small">({{ $list->followItems->count() }})</span>
                    @endif

                    @if ($list->description)
                        <p class="mb-0 widget-expandable-details"><small>{{ $list->description }}</small></p>
                    @endif

                    <p class="mt-2 mb-0 widget-expandable-details">
                        @if($list->is_public)
                            <span class="text-success"><i class="fa-strong far fa-eye"></i> Public</span>
                        @else
                            <span class="text-muted"><i class="fa-strong far fa-lock-alt"></i> Private</span>
                        @endif
                    </p>
                </div>

                @if($show_more == false)
                    <div class="right-side font-size-small align-self-end">
                        <a href="{{ route('member.follow-lists.edit', $list->slug) }}" class="text-primary text-decoration-none me-2"><i class="fa-strong far fa-edit"></i> Edit</a>

                        <button type="button" class="btn btn-link btn-sm p-0 text-danger text-decoration-none" data-toggle="modal" data-target="#delete-list-{{$list->id}}">
                            <i class="fa-strong far fa-trash-alt"></i> Delete
                        </button>
                    </div>
                    @include('members.follow-lists.modals.delete')
                @endif

            </li>
        @endforeach

        @if($show_more == true)
            <li class="list-group-item">
                <a href="{{ route('member.follow-lists.index') }}" class="text-small text-body-emphasis text-uppercase text-decoration-none fw-bold">
                    <span class="me-1">See All Lists</span>
                    <i class="fa-strong far fa-chevron-double-right text-danger"></i>
                </a>
            </li>
        @endif
    </ul>
@else
    <p>You don't have any lists yet.</p>
@endif
