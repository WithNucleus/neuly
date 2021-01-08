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
                <small><a href="{{ url($crud->route) }}" class="hidden-print font-sm"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a></small>
            @endif
        </h2>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Publish {{ ucwords($type) }}</h3>
                </div>
                <div class="card-body">
                    <form class="row" method="post" action="/admin/listingrequest/{{ $id }}/publish" enctype="multipart/form-data">
                        <div class="col-12">
                        @if($update)
                            <div class="row">
                                <h3 class="col-6">Original Data:</h3>
                                <h3 class="col-6">Submitted Data:</h3>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="entity_name">Slug:</label>
                                    <input type="text" class="form-control" name="original_slug" value="{{ $original->slug }}" disabled>
                                    <a href="#" class="btn btn-sm btn-link btn-restore-slug">use original data</a>
                                </div>
                                <div class="form-group col-6">
                                    <label for="entity_name">Slug:</label>
                                    <input type="text" class="form-control" name="entity_slug" value="{{ $original->slug }}">
                                </div>
                            </div>

                            @include('vendor.backpack.crud.listing_requests.update_forms.'.strtolower($type))
                        @else
                                <div class="form-group">
                                    <label for="entity_name">Slug:</label>
                                    <input type="text" class="form-control" name="entity_slug">
                                </div>

                                <script>
                                    window.onload = function () {

                                        // Get Field Name to Listen for Updating the Slug, otherwise default to 'name'
                                        var fieldNameClass = 'js-entity_name';

                                        var slug = slugify(document.getElementsByClassName(fieldNameClass)[0].value);
                                        console.log("slug: " + slug);
                                        document.getElementsByName('entity_slug')[0].value = slug;

                                        // Set Event Listener on Name Field
                                        document.getElementsByClassName(fieldNameClass)[0].addEventListener('input', updateName);

                                        // Update Slug Field Function
                                        function updateName(e) {

                                            var newSlug = '';

                                            // Get Name
                                            var nameValue = document.getElementsByClassName(fieldNameClass)[0].value;

                                            // Slugify
                                            if (nameValue) {
                                                newSlug = slugify(nameValue);
                                            }

                                            // Update Slug Field
                                            document.getElementsByName('entity_slug')[0].value = newSlug;

                                        }

                                        // Slugify Function
                                        function slugify(string) {

                                            const a = 'àáâäæãåāăąçćčđďèéêëēėęěğǵḧîïíīįìłḿñńǹňôöòóœøōõőṕŕřßśšşșťțûüùúūǘůűųẃẍÿýžźż·/_,:;'
                                            const b = 'aaaaaaaaaacccddeeeeeeeegghiiiiiilmnnnnoooooooooprrsssssttuuuuuuuuuwxyyzzz------'
                                            const p = new RegExp(a.split('').join('|'), 'g')

                                            return string.toString().toLowerCase()
                                                .replace(/\s+/g, '-') // Replace spaces with -
                                                .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
                                                .replace(/&/g, '-and-') // Replace & with 'and'
                                                .replace(/[^\w\-]+/g, '') // Remove all non-word characters
                                                .replace(/\-\-+/g, '-') // Replace multiple - with single -
                                                .replace(/^-+/, '') // Trim - from start of text
                                                .replace(/-+$/, '') // Trim - from end of text
                                        }

                                    }
                                </script>

                                @include('vendor.backpack.crud.listing_requests.entity_forms.'.strtolower($type))
                        @endif
                        </div>
                        <div class="col-12">
                            @csrf

                            <div class="form-group">
                                <input type="hidden" name="type" value="{{ $type }}" />
                                <input type="hidden" name="update" value="{{ $update }}" />
                            </div>

                            <div class="form-group text-right">
                                {!! $declineButton !!}
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
            </form>
        </div>
    </div>

<style>
    .form-group.col-6 {
        padding-top: 1rem;
    }

    .form-group.bg-success {
        border-radius: .25rem;
    }
</style>
@endsection

@section('after_scripts')
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('packages/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function (){
            $('.datepicker').datepicker({
                format: '{{ config('app.datepicker_input_format') }}'
            });
        });
    </script>
@endsection
