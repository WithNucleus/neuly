@extends('layouts.app')

@section('body-class', 'page-events bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container-fluid">

        {{-- Sidebar and Content Area --}}
        <div class="row">
            <main id="content-main" role="main" class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                <div class="row">

                    <div class="col-12">
                        <div class="card mt-3 shadow-sm">
                            <div class="card-body">
                                <h1 class="text-center text-primary">Give us some feedback</h1>
                                @include('discover.includes.status-messages')

                                <form method="post" action="/feedback" class="max-width-450">
                                    <div class="form-group">
                                        <label for="title" class="font-weight-bold">Title:</label>
                                        <input type="text" class="form-control" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label for="type" class="font-weight-bold">Type:</label>
                                        <select class="custom-select" name="type">
                                            <option selected></option>
                                            <option value="feedback">Feedback</option>
                                            <option value="problem">Problem</option>
                                            <option value="bug">Bug</option>
                                            <option value="suggestion">Suggestion</option>
                                            <otion value="feature request">Feature Request</otion>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="content" class="font-weight-bold">Message:</label>
                                        <textarea class="form-control" name="content" rows="15"></textarea>
                                    </div>

                                    @unless (Auth::check())
                                        <div class="form-group">
                                            <label for="user_name" class="font-weight-bold">Your Name:</label>
                                            <input type="text" class="form-control" name="user_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_email" class="font-weight-bold">Your e-mail:</label>
                                            <input type="text" class="form-control" name="user_email">
                                        </div>
                                    @endunless
                                    @csrf
                                    <div class="form-group">
                                        <button class="btn btn-primary float-right" type="submit">submit</button>
                                    </div>
                                    @honeypot
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection


