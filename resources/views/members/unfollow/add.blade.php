@extends('layouts.show-modal')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('members.includes.status-messages')
        </div>
        <div class="col-12 col-md-6">
            <form action="{{ route('member.unfollow.store', ['entity' => $entity, 'id' => $id]) }}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                @csrf
                <p class="lead">Are you sure?</p>
                <button class="btn btn-primary">Yes</button>
            </form>
        </div>
    </div>
@endsection
