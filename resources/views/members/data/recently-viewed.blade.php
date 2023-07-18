<?php
/**
 * @param boolean $show_more
 * @param boolean $shadow
 */
?>
<ul class="list-group">
    @if ($recently_viewed->count() > 0)
        @foreach ($recently_viewed as $item)
            @php
            if ($item->properties['entity'] == 'clinicaltrials') :
                $entity_name = 'Clinical Trials';
            elseif ($item->properties['entity'] == 'member-notes') :
                $entity_name = 'Notes';
            else :
                $entity_name = ucwords($item->properties['entity']);
            endif;

            $route = 'discover.' . $item->properties['entity'] . '.show';
            @endphp
            <li class="list-group-item d-flex">
                <div class="recently-viewed-image me-3 widget-expandable-details">
                    @if (!empty($item->properties['image']) && file_exists('storage/' . $item->properties['image']))
                        <img src="storage/{{ $item->properties['image'] }}" alt="{{ $item->description }}" class="logo">
                    @else
                        <img src="{{ asset('images/icons/' . $item->properties['entity'] . '.svg') }}" alt="{{ $item->description }}">
                    @endif
                </div>
                <div class="content d-flex w-100 flex-wrap">
                    <div class="w-100">
                        <a href="{{ route($route, $item->properties['slug']) }}" class="lead fw-bold">{{ $item->description }}</a>
                    </div>

                    <span class="me-4 widget-expandable-details">
                        <i class="fa-strong far fa-clock"></i>
                        <span>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                    </span>

                    <span class="me-4 widget-expandable-details text-success">
                        <i class="fa-strong far fa-tags"></i>
                        <span>{{ $entity_name }}</span>
                    </span>
                </div>
            </li>
        @endforeach
        @if($show_more == true AND $recently_viewed->count() > 3)
            <li class="list-group-item">
                <small><a href="" class="text-dark text-decoration-none fw-bold">
                    See More History <i class="fa-strong far fa-chevron-double-right text-danger"></i>
                </a></small>
            </li>
        @endif
    @else
        You haven't viewed anything yet.
    @endif
</ul>
