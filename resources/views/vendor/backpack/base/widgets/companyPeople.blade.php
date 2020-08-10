@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')
	<div class="{{ $widget['class'] ?? 'well mb-2' }}">
		<div class="alert alert-primary"><strong>{!! $widget['content'] !!}</strong></div>

		{{-- {{ $company->name }} --}}

		{{-- @php
		var_dump($widget)
		@endphp --}}

		{{-- @php
		echo '<strong>Type: ' . gettype($widget['company']) . '</strong><br><br>';
		echo '<pre>';
		print_r($widget['company']['people']);
		echo '</pre>';
		@endphp --}}

		<hr>
		
		@foreach ($widget['company']['people'] as $person)
			 {{-- {{ $person->name }} ({{ $person->pivot_position }}) --}}
			 {{ $person->name }} ({{ $person->getOriginal('pivot_position') }})

			 {{-- <pre>
				@php
				print_r($person)
				@endphp
			</pre> --}}
		@endforeach




	</div>
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')