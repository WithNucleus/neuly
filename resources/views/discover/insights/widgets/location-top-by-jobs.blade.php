<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center">Top 10 Locations With Jobs</h3>

        <ul class="list-group js-top-ten-list-chart" data-action="{{ route('insights.location-top-by-jobs') }}" data-icon-class="fa fa-briefcase" style="display: none;">
            <li class="js-item-template d-none py-2 list-group-item d-flex flex-wrap text-right justify-content-between border-top-0 border-left-0 border-right-0">
                <span class="d-inline-block text-no-wrap js-item-link">
				</span>
                <span class="d-inline-block flex-grow-1 text-no-wrap text-right text-danger js-item-bar">
                </span>
            </li>
        </ul>

        <p class="mb-0 text-center"><a href="{{ route('discover.locations') }}" class="btn btn-sm btn-dark">Explore Locations</a></p>
    </div>
</div>
