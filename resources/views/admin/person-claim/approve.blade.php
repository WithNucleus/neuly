@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Claim approved!</span>
            <a href="/admin/person-claim" class="font-sm"><i class="la la-angle-double-left"></i> Back to <span>Raised Claims</span></a>
        </h2>
    </div>
@endsection

@section('content')
    <div class="row mt-4">

        <div class="col-12">
            <div class="alert alert-success" role="alert">
                The claim was approved successfully!
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <a href="/admin/person-claim" class="btn btn-default">Back to raised claims</a>
        </div>
    </div>
@endsection
