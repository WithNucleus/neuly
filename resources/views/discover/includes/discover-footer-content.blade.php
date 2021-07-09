<hr class="mt-5 mb-5">

<div class="row">
    <div class="col-12 col-xl-4">

        @isset($embedWidgetLink)
            <h2 class="h5 d-flex align-items-start mt-1">
                <i class="fad fa-window-maximize text-info fa-xs pt-1"></i>
                <a href="{{ $embedWidgetLink }}" class="text-dark">
                    <span class="ml-1">Get embed widget</span>
                </a>
            </h2>
        @endisset
        @if(Route::is('discover.jobs'))
            <h2 class="h5 d-flex align-items-start mt-1">
                <i class="fad fa-calendar text-info fa-xs pt-1"></i>
                <a href="{{ route('discover.jobs-archive') }}" class="text-dark">
                    <span class="ml-1">Jobs Archive</span>
                </a>
            </h2>
        @endif
        <h2 class="h5 d-flex align-items-start">
        	<i class="fad fa-info-circle text-info fa-xs pt-1"></i>
        	<a href="/what-data-is-included" class="text-dark">
        		<span class="ml-1">What Data is Included?</span>
        	</a>
        </h2>

    </div>
</div>

@include('footers.mini')
