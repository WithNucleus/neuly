@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')
    @include('navbars.primary')

    <div class="container-fluid">
        <div class="row">
            <main id="content-main" role="main" class="col-lg-10 col-xl-8 mx-auto">

                @include('discover.includes.status-messages')

                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3 shadow-sm">
                            <div class="card-body">
                                <h1 class="text-center text-primary page-title-default">Request deletion for "{{ $person->name }}"</h1>

                                <div class="row">
                                    <div class="col-lg-8 mx-auto mt-4">
                                        <form method="post" action="{{ route('discover.people.requestDeletion', $person->slug) }}" style="max-width: 600px;" class="mx-auto">
                                            @csrf

                                            @auth
                                                <input type="hidden" name="name" value="{{ Auth::user()->name . ' ' . Auth::user()->last_name }}">
                                                <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                            @else
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="name" value="" required>
                                                </div>

                                                <div class="form-group">
                                                    <label class="font-weight-bold">Email <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="email" name="email" value="" required>
                                                </div>
                                            @endauth

                                            <div class="form-group">
                                                <label class="font-weight-bold">Why do you want to delete this record? <span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="cause" required></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Send</button>
                                            <a class="btn btn-default" href="{{ route('discover.people.show', $person->slug) }}">Cancel</a>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                @include('footers.mini')
            </main>
        </div>
    </div>
@endsection
