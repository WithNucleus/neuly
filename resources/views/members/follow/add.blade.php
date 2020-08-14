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
                <p>Set your notification options.</p>
                <div>
                    <input type="hidden" name="email_notification" id="email_notification" value="0">
                    <input type="checkbox" name="email_notification" id="email_notification" value="1"> Email notifications
                </div>
                <div>
                    <input type="hidden" name="app_notification" id="app_notification" value="0">
                    <input type="checkbox" name="app_notification" id="app_notification" value="1"> Neuly notifications
                </div>
                <button>follow</button>
            </form>
        </div>
    </div>
@endsection
