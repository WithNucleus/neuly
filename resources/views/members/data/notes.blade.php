<?php
/**
 * @param boolean $show_more
 * @param boolean $shadow
 */
?>

@if ($notes->count() > 0)
    <ul class="list-group @if($shadow == true)shadow-sm @endif">
        @foreach ($notes as $note)

            <li class="list-group-item">
                <p class="lead fw-bold mb-1">
                    <a href="{{ route('member.notes.show', $note->slug) }}">{{ $note->title }}</a>
                </p>

                <div class="d-flex flex-wrap justify-content-between align-items-end">
                    <div class="left-side font-size-small widget-expandable-details">
                        <i class="fa-strong far fa-clock"></i> Last updated {{ \Carbon\Carbon::parse($note->updated_at)->diffForHumans() }}

                        @if($note->visibility == 'public')
                            <span class="ms-3 text-success"><i class="fa-strong far fa-eye"></i> Public</span>
                        @elseif($note->visibility == 'private')
                            <span class="ms-3 text-secondary"><i class="fa-strong far fa-lock-alt"></i> Private</span>
                        @endif
                    </div>

                    <div class="font-size-small widget-expandable-details">
                        <a href="{{ route('member.notes.edit', $note->slug) }}" class="btn btn-sm btn-primary me-2">
                            Edit
                        </a>
                        <a href="{{ route('member.notes.destroy', $note->id) }}" class="btn btn-sm btn-primary confirm-action text-decoration-none">
                            Delete
                        </a>
                    </div>
                </div>
            </li>
        @endforeach
        @if($show_more)
            <li class="list-group-item d-flex align-items-center flex-wrap justify-content-between">
                <a href="{{ route('member.notes.index') }}" class="text-small text-body-emphasis text-uppercase text-decoration-none fw-bold">
                    <span class="me-1">See All Notes</span>
                    <i class="fa-strong far fa-chevron-double-right text-danger"></i>
                </a>

                <a href="{{ route('member.notes.index') }}" class="text-small text-body-emphasis text-uppercase text-decoration-none fw-bold">
                    <span class="me-1">New Note</span>
                    <i class="fa-strong far fa-file-circle-plus text-success"></i>
                </a>
            </li>
        @endif
    </ul>
@else
    <p class="fs-6">You don't have any notes yet. Do you want to <a href="{{ route('member.notes.create') }}"> add one</a>?</p>
@endif
