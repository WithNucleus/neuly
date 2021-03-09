<?php
use App\Helpers\Entity\FieldsMapping;
use App\Helpers\Import\Serpapi\DataViewBuilder;
use App\Helpers\ListingRequestHelper;
?>
@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Review SerpApi data</span>
            <a href="{{ url()->previous() }}" class="font-sm"><i
                    class="la la-angle-double-left"></i> Back to
                <span>Results</span></a>
        </h2>
    </div>
@endsection

@section('content')
    <form method="post" action="{{ route('admin.import.company.serpapi-data.review', $serpapiData->id) }}">
        @csrf

        <div class="row mt-1">
            <div class="col-12">
                <div class="card card-body">
                    <h3 class="h4">Knowledge Graph Data</h3>
                    <table class="table table-bordered table-responsive">
                        <tbody>
                        @foreach($serpapiData->knowledge_graph as $field => $data)
                            <tr>
                                <td class="bold">{{ ucfirst($field) }}</td>
                                <td>{!! DataViewBuilder::buildNestedDataView($data) !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-12">
                <div class="card card-body">
                    <h3 class="h4">Company data</h3>
                    @foreach($fieldsMapping as $field => $options)
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    {{ isset($options['label']) ? $options['label'] : FieldsMapping::makeLabelFromFieldName($field) }}
                                </label>
                                @include('admin.listing_requests.includes.fields.' . ListingRequestHelper::getFieldViewByMappingOptions($options), [
                                    'entity' => $company,
                                    'isOriginalEntity' => false,
                                ])
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Update entity & reviewed</button>
                <a href="{{ route('admin.import.company.serpapi-data.markAsReviewed', $serpapiData->getKey()) }}" class="btn btn-default"> Mark as reviewed</a>
                <a href="{{ route('admin.import.company.serpapi-data.index') }}" class="btn btn-default"> Cancel</a>
            </div>
        </div>
    </form>

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
        });
    </script>
@endsection
