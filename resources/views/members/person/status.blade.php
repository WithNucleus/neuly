@extends('layouts.app')

@section('body-class', 'page-user-settings bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container">
        <main id="content-main" role="main" class="col-12">
            <div class="row">
                <div class="col-12 col-xl-10 mx-auto bg-white p-4 shadow-sm">

                    <h1 class="page-title-default text-primary mb-4">Person Claiming Status</h1>

                    <div class="py-4 col-12 col-lg-12">

                        @if($user->person_id !== null)
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                You have already claimed a person successfully. You can manage it <a href="{{ route('user.person.index') }}">here</a>
                            </div>
                        @else
                            @if(count($claims) === 0)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    You haven't claimed a person yet. Curious? Have a look <a href="{{ route('user.person.index') }}">here</a>.
                                </div>
                            @else
                                @include('members.person.verify')
                            @endif
                        @endif
                    </div>

                </div>
            </div>
        </main>
    </div>

    @include('footers.mini')

@endsection
