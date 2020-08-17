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
            <form action="{{ route('member.follow.store', ['entity' => $entity, 'id' => $id]) }}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                @csrf
                <p class="lead mb-2">Set your notification options.</p>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="email_notification" id="email_notification" class="custom-control-input" value="1">
                        <label for="email_notification" class="custom-control-label">Email notifications</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="app_notification" id="app_notification" class="custom-control-input" value="1">
                        <label for="app_notification" class="custom-control-label">Neuly notifications</label>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
