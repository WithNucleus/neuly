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
                    <a href="{{ route('member.bookmarks.show-list', $list->slug) }}" class="font-weight-bold">{{ $list->name }}</a>

                    @if ($list->bookmarks->count() > 0)
                        <span class="font-size-small">({{ $list->bookmarks->count() }})</span>
                    @endif

                    @if ($list->description != '')
                        <p class="mb-0"><small>{{ $list->description }}</small></p>
                    @endif

                    <p class="mt-2 mb-0">
                    @if($list->is_public)
                        <span class="text-success"><i class="fad fa-eye"></i> Public</span>
                    @else
                        <span class="text-muted"><i class="fad fa-lock-alt"></i> Private</span>
                    @endif
                    </p>
                </div>

                @if($show_more == false)
                <div class="right-side font-size-small align-self-end">
                    <a href="{{ route('member.bookmarks.edit-list', $list->slug) }}" class="text-primary text-decoration-none mr-2"><i class="fad fa-edit"></i> Edit</a>

                    <button type="button" class="btn btn-link btn-sm p-0 text-danger text-decoration-none" data-toggle="modal" data-target="#delete-list">
                        <i class="fad fa-trash-alt"></i> Delete
                    </button>
                </div>
                @endif
            </li>
        @endforeach
        @if($show_more == true)
            <li class="list-group-item">
                <small><a href="{{ route('member.bookmarks.index') }}" class="text-dark text-decoration-none font-weight-bold">
                    See All Lists <i class="fad fa-chevron-double-right text-danger"></i>
                </a></small>
            </li>
        @endif
    </ul>
@else
    <p>You don't have any lists yet.</p>
@endif

@include('members.bookmarks.delete-list-modal')
