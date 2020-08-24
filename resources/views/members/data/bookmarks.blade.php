<?php
/**
 * @param boolean $show_more_bookmarks
 * @param boolean $shadow
 * @param boolean $show_action_items
 */
?>

@if ($bookmarks->count() > 0)
    <ul class="list-group @if($shadow == true)shadow-sm @endif">
        @foreach ($bookmarks as $bookmark)
            @php
            $bookmark_link = $bookmark->slug($bookmark->entity, $bookmark->entity_id);
            @endphp

            <?php
            if ($bookmark->entity == 'clinicaltrials') :
                $entity_name = 'Clinical Trials';
            elseif ($bookmark->entity == 'member-notes') :
                $entity_name = 'Notes';
            else :
                $entity_name = ucwords($bookmark->entity);
            endif;
            ?>
            <li class="list-group-item d-flex">

                <div class="image mr-2">
                    <div class="bookmark-image" data-toggle="tooltip" data-placement="top" title="{{ $entity_name }}">
                        <img src="{{ asset('images/icons/' . $bookmark->entity . '.svg') }}" alt="{{ $bookmark->name }}">
                    </div>
                </div>

                <div class="content d-flex w-100 flex-wrap flex-wrap">
                    <div class="w-100">
                        <a href="{{ route($bookmark_link['route'], $bookmark_link['slug']) }}" class="font-weight-bold">{{ $bookmark->name }}</a>
                        @if ($bookmark->notes != '')
                            <p class="mb-1"><small>{{ $bookmark->notes }}</small></p>
                        @endif
                    </div>

                    <div class="d-flex flex-wrap justify-content-between w-100">

                        <span class="font-size-small mr-5">
                            <span class="mr-3">
                                <i class="fad fa-clock"></i> {{ Carbon\Carbon::parse($bookmark->created_at)->format('M, d, Y') }}
                            </span>

                            <a href="{{ route('member.bookmarks.show-list', $bookmark->list->slug) }}" class="text-decoration-none text-dark font-weight-bold">
                                <i class="fad fa-list-alt"></i> {{ $bookmark->list->name }}
                            </a>
                        </span>

                        @if($show_action_items == true)
                        <span class="font-size-small">
                             <a href="{{ route('member.bookmarks.edit', $bookmark->id) }}" class="text-primary text-decoration-none mr-3"><i class="fad fa-edit"></i> Edit</a>

                             <a href="{{ route('member.bookmarks.destroy', $bookmark->id) }}" class="text-danger confirm-action text-decoration-none"><i class="fad fa-trash-alt"></i> Delete</a>
                        </span>
                        @endif

                    </div>

                </div>

            </li>
        @endforeach
        @if($show_more_bookmarks == true)
            <li class="list-group-item">
                <small><a href="{{ route('member.bookmarks.all') }}" class="text-dark text-decoration-none font-weight-bold">
                    See All Bookmarks <i class="fad fa-chevron-double-right text-danger"></i>
                </a></small>
            </li>
        @endif
    </ul>
@else
    @if(isset($public_view) && $public_view == true)
        <p>This list don't have any bookmarks yet.</p>
    @else
        <p>You don't have any bookmarks yet. You can save everything in Neuly to your bookmarks - watch out for this icon <i class="fad fa-bookmark text-primary"></i> to add items to your lists.</p>
    @endif
@endif
