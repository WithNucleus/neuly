<?php
/**
 * @param boolean $show_more
 * @param boolean $shadow
 */
?>
<ul class="list-group">
    @if ($recently_viewed->count() > 0)
        @foreach ($recently_viewed as $item)
            <?php
            if ($item->properties['entity'] == 'clinicaltrials') :
                $entity_name = 'Clinical Trials';
            elseif ($item->properties['entity'] == 'member-notes') :
                $entity_name = 'Notes';
            else :
                $entity_name = ucwords($item->properties['entity']);
            endif;

            $route = 'discover.' . $item->properties['entity'] . '.show';
            ?>
            <li class="list-group-item d-flex">

                {{-- Image --}}
                <div class="recently-viewed-image mr-3">
                    @if (!empty($item->properties['image']) && file_exists('storage/' . $item->properties['image']))
                        <img src="storage/{{ $item->properties['image'] }}" alt="{{ $item->description }}" class="logo">
                    @else
                        <img src="{{ asset('images/icons/' . $item->properties['entity'] . '.svg') }}" alt="{{ $item->description }}">
                    @endif
                </div>

                {{-- Content --}}
                <div class="content d-flex w-100 flex-wrap">
                    <div class="w-100">
                        <a href="{{ route($route, $item->properties['slug']) }}" class="font-weight-bold">{{ $item->description }}</a>
                    </div>

                    <span class="mr-4 font-size-small">
                        <i class="fad fa-clock text-black-50"></i> {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                    </span>

                    <span class="mr-4 font-size-small">
                        <i class="fad fa-tags text-secondarydark"></i> {{ $entity_name }}
                    </span>
                </div>
            </li>
        @endforeach
        @if($show_more == true AND $recently_viewed->count() > 3)
            <li class="list-group-item">
                <small><a href="" class="text-dark text-decoration-none font-weight-bold">
                    See More History <i class="fad fa-chevron-double-right text-danger"></i>
                </a></small>
            </li>
        @endif
    @else
        You haven't viewed anything yet.
    @endif
</ul>
