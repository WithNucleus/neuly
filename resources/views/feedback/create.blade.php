@extends('layouts.app')

@section('content')

    @include('navbars.primary')

    <div class="container my-5">
        <h1 class="text-center text-primary">Give us some feedback</h1>
        <form method="post" action="/feedback" class="max-width-600 mx-auto">
            <div class="mb-3">
                <label for="title" class="fw-bold text-uppercase">Title:</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title">
                @error('title') <div class="small text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="type" class="fw-bold text-uppercase">Type:</label>
                <select class="form-select @error('type') is-invalid @enderror" name="type" id="type">
                    <option selected></option>
                    <option value="feedback">Feedback</option>
                    <option value="problem">Problem</option>
                    <option value="bug">Bug</option>
                    <option value="suggestion">Suggestion</option>
                    <option value="feature request">Feature Request</option>
                </select>
                @error('type') <div class="small text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="fw-bold text-uppercase">Message:</label>
                <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="6" id="content"></textarea>
                @error('content') <div class="small text-danger">{{ $message }}</div> @enderror
            </div>

            @unless (Auth::check())
                <div class="mb-3">
                    <label for="user_name" class="fw-bold text-uppercase">Your Name:</label>
                    <input type="text" class="form-control" name="user_name">
                </div>
                <div class="mb-3">
                    <label for="user_email" class="fw-bold text-uppercase">Your e-mail:</label>
                    <input type="text" class="form-control" name="user_email">
                </div>
            @endunless
            @csrf
            <div>
                <button class="btn btn-primary float-right" type="submit">submit</button>
            </div>
            @honeypot
        </form>
    </div>
@endsection


