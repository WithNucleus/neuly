@extends(backpack_user() && (Str::startsWith(\Request::path(), config('backpack.base.route_prefix'))) ? 'backpack::layouts.top_left' : 'backpack::layouts.plain')
{{-- show error using sidebar layout if looged in AND on an admin page; otherwise use a blank page --}}

@php
  $title = 'Error';
@endphp

@section('after_styles')
	<style>
		.error_number {
			font-size: 156px;
			font-weight: 600;
			line-height: 100px;
		}
		.error_number small {
			font-size: 56px;
			font-weight: 700;
		}

		.error_title {
			margin-top: 40px;
			font-size: 36px;
			font-weight: 400;
		}

		.error_description {
			font-size: 20px;
			font-weight: 400;
		}
	</style>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12 text-center">
			@hasrole('Admin')
				<div class="error_number">
					<small>ERROR</small><br>
					{{ $error_number }}
				</div>
				<div class="error_title text-muted">
					@yield('title')
				</div>
				<div class="error_description text-muted">
					@yield('description')
				</div>
				<div class="error_description text-muted">
					<a href="javascript:history.back()">Go back</a> or <a href="{{ route('home') }}">go home</a>
				</div>
			@else
				<div class="error_number">
					<small>ERROR</small><br>
				</div>
				<div class="error_description text-muted">
					<p>Apologies - we can't find what you're looking for.</p>
					Please <a href="javascript:history.back()">go back</a> or return to <a href="{{ route('home') }}">our homepage</a>.
				</div>
			@endhasrole
		</div>
	</div>
@endsection