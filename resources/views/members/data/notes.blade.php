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
                <p class="lead font-weight-bold mb-0">
                    <a href="{{ route('member.notes.show', $note->slug) }}">{{ $note->title }}</a>
                </p>

                <div class="d-flex flex-wrap justify-content-between">
                    <div class="left-side font-size-small">
                        <i class="fad fa-clock"></i> Last updated {{ \Carbon\Carbon::parse($note->updated_at)->diffForHumans() }}

                        @if($note->visibility == 'public')
                            <span class="ml-3 text-success"><i class="fad fa-eye"></i> Public</span>
                        @elseif($note->visibility == 'private')
                            <span class="ml-3 text-muted"><i class="fad fa-lock-alt"></i> Private</span>
                        @endif
                    </div>

                    <div class="right-side font-size-small">
                        <a href="{{ route('member.notes.edit', $note->slug) }}" class="text-primary text-decoration-none mr-2"><i class="fad fa-edit"></i> Edit</a>
                        <a href="{{ route('member.notes.destroy', $note->id) }}" class="text-danger confirm-action text-decoration-none"><i class="fad fa-trash-alt"></i> Delete</a>
                    </div>
                </div>
            </li>
        @endforeach
        @if($show_more == true)
            <li class="list-group-item d-flex align-items-center flex-wrap justify-content-between">
                <small><a href="{{ route('member.notes.index') }}" class="text-dark text-decoration-none font-weight-bold">
                    See All Notes <i class="fad fa-chevron-double-right text-danger"></i>
                </a></small>

                <small><a href="{{ route('member.notes.create') }}" class="text-dark text-decoration-none font-weight-bold">
                    <i class="fad fa-pencil text-secondary"></i> New Note
                </a></small>
            </li>
        @endif
    </ul>
@else
    <p>You don't have any notes yet. Do you want to <a href="{{ route('member.notes.create') }}"> add one</a>?</p>
    {{-- <p><a href="{{ route('member.notes.create') }}" class="btn btn-primary"><i class="fad fa-pencil"></i> Add Note</a></p> --}}
@endif