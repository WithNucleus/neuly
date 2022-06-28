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
                                <p class="text-center lead">
                                @isset($entity)
                                    Update {{ $entityType }} "{{ $entity->name }}"
                                @else
                                    Create {{ $entityType }}
                                @endisset
                                </p>

                                <form method="post" action=" {{ route('listing.request.finish') }}" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="entity_type" value="{{ $entityType }}"/>
                                    @isset($entity)
                                        <input type="hidden" name="to_update_id" value="{{ $entity->id }}"/>
                                    @endisset

                                    {{--collect name and email if user not authorized--}}
                                    @guest
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Your name:</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="applicant_name" value="" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Your email:</label>
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" name="applicant_email" value="" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endguest
                                    <p class="text-center">Use the form below to add or update information for this {{ $entityType }}.</p>

                                    @foreach($mapping as $field => $options)
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label
                                                        class="font-weight-bold">{{ isset($options['label']) ? $options['label'] : FieldsMapping::makeLabelFromFieldName($field) }}</label>
                                                    @include('discover.listing-requests.fields.' . ListingRequestHelper::getFieldViewByMappingOptions($options))
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @isset($previewRequest)
                                        @guest
                                            <input type="hidden" name="entity_type" value="{{ $previewRequest['type'] }}">
                                            <input type="hidden" name="to_update_id" value="{{ $previewRequest['id'] }}">
                                            <input type="hidden" name="preview_request" value="{{ $previewRequest['code'] }}">

                                            <div class="form-group">
                                                <p class="font-weight-bold lead mb-0">
                                                    Your Info
                                                </p>
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <label for="user_name">Name</label>
                                                        <input type="text" name="user_name" class="form-control" required>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label for="user_email">Email</label>
                                                        <input type="text" name="user_email" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        @endguest
                                    @endisset

                                    <div class="form-group">
                                        <label class="font-weight-bold">Any additional info about this {{ $entityType }} or comments for the Neuly team?</label>
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
    <link href="{{ asset('packages/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <script src="{{ asset('packages/select2/dist/js/select2.full.min.js') }}"></script>
    {{-- datepicker --}}
    <link rel="stylesheet" type="text/css"
          href="{{ asset('packages/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"/>
    <script type="text/javascript"
            src="{{ asset('packages/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    {{-- ckeditor --}}
    <script src="{{ asset('packages/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('packages/ckeditor/adapters/jquery.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2();

            $('.datepicker').datepicker({
                format: '{{ config('app.datepicker_input_format') }}'
            });

            $('.ckeditor-min').ckeditor({
                toolbarGroups: [
                    {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
                    {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
                    {name: 'styles'},
                    {name: 'colors'}
                ]
            });

            $('.js-morphable-input-type:checked').each(function () {
                initMorphableSelect($(this), true);
            });

            $('.js-morphable-input-type').on('change', function () {
                initMorphableSelect($(this))
            });
        });

        function initMorphableSelect(toggleInput, selectCurrentValue = false) {
            let allContainers = $(toggleInput.data('group')),
                targetContainer = $(toggleInput.data('target')),
                targetSelect = targetContainer.find('select'),
                getListActionUrl = targetSelect.data('fetch-action'),
                currentIdValue = targetSelect.data('current-value');

            allContainers.hide();
            allContainers.find('select').prop('disabled', true);
            targetSelect.prop('disabled', false);
            targetContainer.show();

            if (targetSelect.hasClass('select2-hidden-accessible') === false) {
                $.getJSON(getListActionUrl, function (response) {
                    if (response.status === 'ok') {
                        let dataArray = response.data;

                        dataArray.forEach((el, i) => {
                            dataArray[i].text = dataArray[i]['name'];
                        });

                        targetSelect.select2({
                            data: dataArray
                        });

                        if (selectCurrentValue && currentIdValue) {
                            targetSelect.val(currentIdValue);
                            targetSelect.trigger('change')
                        }
                    }
                });
            }
        }
    </script>
@endsection
