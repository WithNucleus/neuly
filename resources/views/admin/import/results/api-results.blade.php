<div class="row mt-1">
    <div class="col-12 col-md-12">
        <div class="card card-body">
            <h3 class="h4">Search Results for <em>{{ urldecode($search_term) }}</em></h3>
            <p class="lead">
                @if(property_exists($api_results, 'search_information'))
                    {{ $api_results->search_information->total_results }} results /
                    {{ $api_results->search_information->organic_results_state }}
                @endif
            </p>

			<ul class="list-group list-group-flush">
				<form action="{{ route('import.research.save') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<li id="select-all-buttons" class="list-group-item border-top-0 border-bottom-0">
						<button id="select-all" class="btn btn-sm btn-primary">Select All</button>
						<button id="unselect-all" class="btn btn-sm btn-light">Unselect All</button>
					</li>
				@foreach ($api_results->organic_results as $listing)
					@isset($listing->link)
						<li class="list-group-item @if($loop->first) border-top-0 @elseif($loop->last) border-bottom-0 @endif">
							<div class="d-flex justify-content-between">
								<div class="input-area flex-shrink-0 flex-grow-0">
                                    @if (array_key_exists($listing->result_id, $current_research))
										<span class="h3">
                                            <a href="{{ route('discover.research.show', $current_research[$listing->result_id]) }}" title="Open Neuly Link"
                                               target="_blank" rel="noopener noreferrer"><i class="las la-check-double text-success mr-2"></i></a>
                                        </span>
									@else
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="import[]" id="{{ $listing->result_id }}" value="{{ $listing->result_id }}">
											<label class="custom-control-label" for="{{ $listing->result_id }}"></label>
										</div>
									@endif
								</div>
								<div class="content flex-grow-1">

									<p class="lead font-weight-normal mb-0">
										<a href="{{ $listing->link }}" target="_blank" rel="noopener noreferrer" class="font-blue">
											{{ $listing->title }}
										</a>
									</p>

									<p class="mb-0 font-green font-large">
										{{ $listing->publication_info->summary }}
									</p>
									@isset($listing->publication_info->authors)
									<p class="mb-0">
										<strong>Author(s):</strong>
										@foreach ($listing->publication_info->authors as $author)
											<a href="{{ $author->link }}" class="font-blue" target="_blank" rel="noopener noreferrer">
												{{ $author->name }}@if(!$loop->last),@endif
											</a>
										@endforeach
									</p>
									@endisset

									@isset($listing->snippet)
										<p class="mb-0 font-small">
											{{ $listing->snippet }}
										</p>
									@endisset

									@isset($listing->resources)
										<p class="mb-0 font-large">
											@foreach ($listing->resources as $resource)
												<span class="mr-2">
													<a href="{{ $resource->link }}" target="_blank" rel="noopener noreferrer">
														@isset($resource->file_format)
															[{{ $resource->file_format }}]
														@endisset
														{{ $resource->title }}
													</a>
												</span>
											@endforeach
										</p>
									@endisset
								</div>
							</div>
						</li>

						<?php
							$listing_details = json_encode($listing);
						?>
						<input type="hidden" name="{{ $listing->result_id }}" value="{{ $listing_details }}">
					@endisset
				@endforeach
				<div class="form-group mt-2 border-top-0">
					<input type="hidden" name="serpapi_pagination" value="{{ $api_results->serpapi_pagination->next_link }}">
					<input type="hidden" name="focus_id" value="{{ $focus->id }}">
					<button id="submit-import-form" type="submit" class="btn btn-primary">Import Selected Items</button>
				</div>
				</form>
			</ul>

			@isset($api_results->serpapi_pagination)
				<form id="more-results-form" action="{{ route('import.research.process') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="serpapi_pagination" value="{{ $api_results->serpapi_pagination->next_link }}">
                    <input type="hidden" name="focus_id" value="{{ $focus->id }}">
                    <input type="hidden" name="api" value="Google Scholar">
                    <input type="hidden" name="search_term" value="{{ $search_term }}">
					<button type="submit" class="btn btn-success">More Search Results</button>
                </form>
			@endisset

        </div>

        <pre>
		<?php //print_r($api_results); ?>
        </pre>
    </div>
</div>

<style>
	.font-large {
		font-size: 1.1rem;
	}

	.font-small {
		font-size: .9rem;
	}

	.font-blue {
		color: #1a0dab;
	}

	.font-green {
		color: #006621;
	}
</style>

<script>

	var importable_items = document.querySelectorAll('input[type="checkbox"]').length;
	console.log("Importable Items: " + importable_items);

	if (importable_items == 0) {
		document.getElementById('submit-import-form').style.display = 'none';
		document.getElementById('select-all-buttons').style.display = 'none';
	}

	document.getElementById("select-all").addEventListener('click', function(event){
	    event.preventDefault();
	    var items=document.getElementsByName('import[]');
		for(var i=0; i<items.length; i++){
			if(items[i].type=='checkbox')
				items[i].checked=true;
		}
	});

	document.getElementById("unselect-all").addEventListener('click', function(event){
	    event.preventDefault();
	    var items=document.getElementsByName('import[]');
		for(var i=0; i<items.length; i++){
			if(items[i].type=='checkbox')
				items[i].checked=false;
		}
	});
</script>
