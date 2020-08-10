@if(count($items) > 0)
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="/">
					Neuly
				</a>
			</li>
			@foreach($items as $name => $url)
				@if($url)
					<li class="breadcrumb-item">
						<a href="{{ $url }}">
							{{ $name }}
						</a>
					</li>
				@else
					<li class="breadcrumb-item active" aria-current="page">
						{{ $name }}
					</li>
				@endif
			@endforeach
		</ol>
	</nav>
@endif
