@extends(backpack_user() && (Str::startsWith(\Request::path(), config('backpack.base.route_prefix'))) ? 'backpack::layouts.top_left' : 'backpack::layouts.plain')
{{-- show error using sidebar layout if looged in AND on an admin page; otherwise use a blank page --}}

@php
  $title = 'Error';
@endphp

@section('after_styles')
	<style>
        .text-muted {
            color: #212529 !important;
        }

		.error_number {
			font-size: 156px;
			font-weight: 600;
			line-height: 100px;
            font-family: Bebas Neue,Avenir,Helvetica,Arial,sans-serif;
            color: #212529;
		}

		.error_number small {
			font-size: 56px;
			font-weight: 700;
            font-family: Bebas Neue,Avenir,Helvetica,Arial,sans-serif;
            color: #212529;
		}

		.error_title {
			margin-top: 40px;
			font-size: 46px;
			font-weight: 700;
            margin-bottom: 20px;
            font-family: Bebas Neue,Avenir,Helvetica,Arial,sans-serif;
            color: #212529;
		}

		.error_description {
			font-size: 24px;
			font-weight: 400;
            max-width: 600px;
            margin: 0 auto 40px;
            font-family: Bebas Neue,Avenir,Helvetica,Arial,sans-serif;
            color: #212529;
		}

        .error_action {
            font-size: 20px;
            font-weight: 400;
            max-width: 600px;
            margin: 0 auto;
            font-family: Bebas Neue,Avenir,Helvetica,Arial,sans-serif;
            color: #212529;
            margin-bottom: 40px;
        }

        .error_feedback {
            font-size: 16px;
            font-weight: 400;
            max-width: 600px;
            margin: 0 auto;
            font-family: Bebas Neue,Avenir,Helvetica,Arial,sans-serif;
            color: #212529;
        }

        a,
        a:hover,
        .error_feedback a,
        .sticky-footer a,
        .error_action a {
            color: #275dad;
            font-weight: 500;
        }

        .background {
            background: url(/images/hero-bg.jpg) no-repeat 50%;
            background-size: cover;
            background-attachment: fixed;
            position: absolute;
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
        }

        .sticky-footer .text-muted{
            font-family: Bebas Neue,Avenir,Helvetica,Arial,sans-serif;
            color: #212529 !important;
        }
	</style>
@endsection

@section('content')
    <div class="background"></div>
	<div class="row">
		<div class="col-md-12 text-center">
			@hasrole('Admin')
				<div class="error_number">
					<small>ERROR</small><br>
					{{ $error_number }}
				</div>
				<div class="error_title">
					@yield('title')
				</div>
				<div class="error_description">
					@yield('description')
				</div>
				<div class="error_description text-muted">
					<a href="javascript:history.back()">Go back</a> or <a href="{{ route('home') }}">go home</a>
				</div>
			@else
                <div class="error_title">
                    @yield('title')
                </div>
                <div class="error_description">
                    @yield('description')
                </div>
                <div class="error_action">
                    Please <a href="javascript:history.back()">go back</a> or return to <a href="{{ route('home') }}">our homepage</a>.
                </div>
                <div class="error_feedback">
                    You got the feeling that something is a bit off?<br /> Please contact us via our <a href="{{ route('feedback.create') }}">feedback form</a>.
                </div>
			@endhasrole
		</div>
	</div>
@endsection
