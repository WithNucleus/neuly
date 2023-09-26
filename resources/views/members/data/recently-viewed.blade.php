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
        <div class="fs-6 mb-3">You haven't viewed anything yet. Might we suggest a few things?</div>
        <div>
            <div class="neuly-help-logo-item mb-3">
                <button class="btn" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse-research" aria-expanded="true"
                        aria-controls="collapse-research">
                    @include('navbars.neuly-research-logo')
                </button>
                <div class="collapse show" id="collapse-research">
                    <div>
                        <ul class="neuly-help-nav-list">
                            @include('navbars._research')
                        </ul>
                    </div>
                </div>
            </div>
            <div class="neuly-help-logo-item mb-3">
                <button class="btn" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse-edu" aria-expanded="false"
                        aria-controls="collapse-edu">
                    @include('navbars.neuly-edu-logo')
                </button>
                <div class="collapse" id="collapse-edu">
                    <div>
                        <ul class="neuly-help-nav-list">
                            @include('navbars._edu')
                        </ul>
                    </div>
                </div>
            </div>
            <div class="neuly-help-logo-item mb-3">
                <button class="btn" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse-care" aria-expanded="false"
                        aria-controls="collapse-care">
                    @include('navbars.neuly-care-logo')
                </button>
                <div class="collapse" id="collapse-care">
                    <div>
                        <ul class="neuly-help-nav-list">
                            @include('navbars._care')
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
</ul>
