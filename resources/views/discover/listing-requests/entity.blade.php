@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')
    @include('navbars.primary')
    <div class="container-fluid">

        <div class="row">

            <main id="content-main" role="main" class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                <div class="row">

                    <div class="col-12">
                        <div class="card mt-3 shadow-sm">
                            <div class="card-body">
                                <h1 class="text-center text-primary">Neuly Listing Request</h1>
                                @include('discover.includes.status-messages')

                                <form method="post" action="/listing/request/finish" enctype="multipart/form-data" class="max-width-450">

                                    @include('discover.listing-requests.entity-forms.'.strtolower($general['type']))

                                    <div class="form-group">
                                        <label for="general_comment" class="font-weight-bold">Any additional info or comments?</label>
                                        <textarea class="form-control" name="general_comment" rows="3"></textarea>
                                    </div>
                                    <input type="hidden" name="general_update" value="{{ $general['update'] }}" />
                                    <input type="hidden" name="general_name" value="{{ $general['name'] }}" />
                                    <input type="hidden" name="general_mail" value="{{ $general['mail'] }}" />
                                    <input type="hidden" name="general_type" value="{{ $general['type'] }}" />
                                    @csrf
                                    <div class="form-group">
                                        <button class="btn btn-primary float-right" type="submit">next</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @include('footers.mini')

            </main>

        </div>

    </div>
@endsection
