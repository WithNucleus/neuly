@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')
    @include('navbars.primary')
    <div class="container-fluid">

        <div class="row">

            <main id="content-main" role="main" class="col-lg-8 mx-auto">
                <div class="row">

                    <div class="col-12">
                        <div class="card shadow-sm mt-3">
                            <div class="card-body">
                                <h1 class="text-center text-primary page-title-default">Are we missing something?</h1>
                                <p class="lead-smaller text-center">
                                    Neuly is the most in depth database for the psychedelics industry, but we’re always looking for ways to improve.
                                </p>
                                <p class="font-size-large text-center">
                                    Please fill out the following form if you’d like to add or edit an organization, people, event, job, or other data set.
                                </p>
                                <div class="col-lg-6 mx-auto mt-4 border-top pt-4">
                                    @auth
                                        <form method="post" action="{{ route('listing.request') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="general_update" class="d-block font-weight-bold">Are you requesting to add or update a resource?</label>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input class="custom-control-input" type="radio" name="general_update" id="new_entry" value="0">
                                                    <label class="custom-control-label" for="new_entry">
                                                        Add New
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input class="custom-control-input" type="radio" name="general_update" id="update_entry" value="1">
                                                    <label class="custom-control-label" for="update_entry">
                                                        Update Existing
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="general_type" class="font-weight-bold">Type of listing</label>
                                                <select id="general_type" class="custom-select" name="general_type">
                                                    @foreach($entityTypes as $alias => $entityClass)
                                                        <option value="{{ $alias }}">{{ ucfirst($alias) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                                <input type="hidden" name="general_name" value="{{ Auth::user()->name }} {{ Auth::user()->last_name }}">
                                                <input type="hidden" name="general_mail" value="{{ Auth::user()->email }}">

                                                <div class="form-group text-right">
                                                    <button class="btn btn-primary ml-auto mr-0" type="submit">next</button>
                                                </div>
                                        </form>
                                        <p class="font-size-small">*Note that Neuly adds new data at the company’s sole discretion.</p>
                                    @else
                                        <div class="text-center">
                                            <p>You must be be logged in to submit a listing request</p>
                                            <a class="btn btn-primary ml-auto mr-0" href="{{ route('login') }}">Login</a>
                                        </div>
                                    @endauth
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
