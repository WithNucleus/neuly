<?php
use App\Helpers\ListingRequestHelper;
use App\Helpers\Entity\FieldsMapping;
?>
@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')
    @include('navbars.primary')
    <div class="container-fluid">
        <div class="row">
            <main id="content-main" role="main" class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                <div class="row">
                    <div class="col-12">
                        @include('discover.includes.status-messages')

                        <div class="card mt-3 shadow-sm">
                            <div class="card-body">
                                <h1 class="text-center text-primary">Neuly Listing Request</h1>
                                @isset($entity)
                                <p class="text-center lead">Update {{ $entityType }} "{{ $entity->name }}"</p>
                                @endisset

                                <form method="post" action=" {{ route('listing.request.finish') }}" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="entity_type" value="{{ $entityType }}" />
                                    @isset($entity)
                                    <input type="hidden" name="to_update_id" value="{{ $entity->id }}" />
                                    @endisset

                                    @foreach($mapping as $field => $options)
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">{{ isset($options['label']) ? $options['label'] : FieldsMapping::makeLabelFromFieldName($field) }}</label>
                                                    @include('discover.listing-requests.fields.' . ListingRequestHelper::getFieldViewByMappingOptions($options))
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="form-group">
                                        <label class="font-weight-bold">Any additional info or comments?</label>
                                        <textarea class="form-control" name="comment" rows="3"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary float-right" type="submit">send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @include('footers.mini')

            </main>

        </div>

    </div>
@endsection

@section('after_scripts')
    {{-- select2 --}}
    <link href="{{ asset('packages/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('packages/select2/dist/js/select2.full.min.js') }}"></script>
    {{-- datepicker --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('packages/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    {{-- ckeditor --}}
    <script src="{{ asset('packages/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('packages/ckeditor/adapters/jquery.js') }}"></script>

    <script>
        $(document).ready(function (){
            $('.select2').select2();

            $('.datepicker').datepicker({
                format: '{{ config('app.datepicker_input_format') }}'
            });

            $('.ckeditor-min').ckeditor({
                toolbarGroups: [
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                    { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                    { name: 'styles' },
                    { name: 'colors' }
                ]
            });
        });
    </script>
@endsection
