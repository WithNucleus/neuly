<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center">Top 10 Locations</h3>

        {{-- <div id="chartTopLocations" style="height: 300px;"></div> --}}

        <ul class="list-group">
        	@foreach ($top_ten_locations_list as $location)
				<li class="py-2 list-group-item d-flex flex-wrap text-right justify-content-between border-top-0 border-left-0 border-right-0 @if ($loop->last) border-bottom-0 @endif">
					<span class="d-inline-block text-no-wrap">
						<a href="{{ route('discover.locations.show', $location['slug']) }}">{{ $location['name'] }}</a>
					</span>

					<span class="d-inline-block flex-grow-1 text-no-wrap text-right">
					<?php
					$percent = round(round($location['count'] / $top_ten_locations_list[0]['count'], 2) * 100 / 5);

					$human = '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="#D81E5B" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>';

					for ($i = 0; $i < $percent; $i++) {
						echo $human;
					}
					?>
					</span>

				</li>
        	@endforeach
        </ul>

        <p class="mb-0 text-center"><a href="{{ route('discover.locations') }}" class="btn btn-sm btn-dark">Explore Locations</a></p>
    </div>
</div>