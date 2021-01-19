@extends(backpack_view('layouts.top_left'))

@php
    $defaultBreadcrumbs = [
      trans('backpack::crud.admin') => backpack_url('dashboard'),
      $crud->entity_name_plural => url($crud->route),
      'Moderate' => false,
    ];

    // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
    $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
    <section class="container-fluid">
        <h2>
            <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
            <small>{!! $crud->getSubheading() ?? 'Moderate '.$crud->entity_name !!}.</small>

            @if ($crud->hasAccess('list'))
                <small><a href="{{ url($crud->route) }}" class="hidden-print font-sm">
                        <i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }}
                        <span>{{ $crud->entity_name_plural }}</span></a></small>
            @endif
        </h2>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="@if($originalEntity) col-md-12 @else col-md-8 @endif">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Publish {{ ucwords($type) }}</h3>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ route('admin.listingrequest.accept', $id) }}"
                          enctype="multipart/form-data">
                        @csrf

                        @if($originalEntity)
                            @include('admin.listing_requests.includes.update_form')
                        @else
                            @include('admin.listing_requests.includes.create_form')
                        @endif

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group text-right">
                                    {!! $declineButton !!}
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
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
