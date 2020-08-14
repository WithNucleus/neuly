@extends('layouts.show-modal')

@section('content')
    <div class="row">
        <div class="col-12">

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
        </div>
        <div class="col-12 col-md-6">
            <form action="{{ route('member.unfollow.store', ['entity' => $entity, 'entity_id' => $id]) }}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                <p>Are you sure you want to unfollow?</p>
                <button>unfollow</button>
            </form>
        </div>
    </div>
@endsection
