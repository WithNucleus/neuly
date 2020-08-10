@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')

    <div class="container">
        <div class="row">
            <div class="col-12 clearfix">
                <h1 class="h2 float-left">
                    <i class="fad fa-clipboard-list text-info"></i> Notes
                </h1>
                <a href="{{ route('member.notes.create') }}" class="btn btn-primary float-right"><i class="fad fa-pencil"></i> Add Note</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="p-4 bg-white shadow-sm">
                    @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger mb-0" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @include('members.data.notes', ['shadow' => false, 'show_more' => false])               
                </div>
            </div>
        </div>
    </div>

    @include('members.includes.dashboard-end')


@endsection
