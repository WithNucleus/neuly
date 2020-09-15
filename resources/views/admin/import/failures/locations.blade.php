@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Import Failures by type</span>
            <a href="{{ url()->previous() }}" class="font-sm"><i
                    class="la la-angle-double-left"></i> Back to
                <span>Import failures</span></a>
        </h2>
    </div>
@endsection

@section('content')
    <div class="row mt-1">
        <div class="col-12 col-md-8">
            <div class="card card-body">
                <h3 class="h4">Failures of Locations</h3>
                <ul class="list-group">
                    @forelse($failures as $failure)
                        <li class="list-group-item js-failure-item-container">
                            @foreach ($failure->details as $key => $detail)
                                <p class="m-1">{{ strtoupper($key) }} : {{ $detail }}</p>
                            @endforeach
                            <div class="row mt-4">

                                <div class="col-6">
                                    <p class="h5">Create and attach location</p>
                                    <div class="form-group">
                                        <label class="font-weight-bold"><span class="text-danger">*</span>Country:</label>
                                        <input type="text" class="form-control" name="country"
                                        value="{{ isset($failure->location_parts) ? $failure->location_parts['country'] : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Region:</label>
                                        <input type="text" class="form-control" name="region"
                                               value="{{ isset($failure->location_parts) ? $failure->location_parts['region'] : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">City:</label>
                                        <input type="text" class="form-control" name="city"
                                               value="{{ isset($failure->location_parts) ? $failure->location_parts['city'] : '' }}">
                                    </div>
                                    <button class="btn btn-primary js-fix-location-failure-button"
                                            data-model="{{ \App\Models\Location::class }}"
                                            data-action="{{ route('import.failures.fix', $failure->id) }}">Add location
                                    </button>
                                </div>

                                <div class="col-6">
                                    <p class="h5">Or attach existing location</p>
                                    <div class="form-group">
                                        <label for="location" class="font-weight-bold"><span class="text-danger">*</span>Search location:</label><br>
                                        <input id="location" class="form-control js-fix-location-search-input" type="text"
                                               data-action="{{ route('admin.entityMerge.getEntityListJson') }}"
                                               data-entity-type="{{ \App\Helpers\EntityHelper::getAliasByClass(\App\Models\Location::class) }}"
                                               autocomplete="false" name="location" value="" disabled="disabled"/>

                                        <input type="hidden" name="location_id" class="js-location-id-input" value=""/>
                                    </div>
                                    <button class="btn btn-primary js-fix-location-failure-attach-button"
                                            data-model="{{ \App\Models\Location::class }}"
                                            data-action="{{ route('import.failures.fix', $failure->id) }}">Attach location
                                    </button>
                                </div>

                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                <button class="btn btn-danger js-delete-failure-button"
                                        data-action="{{ route('import.failures.delete', $failure->id) }}">Delete
                                </button>
                                <p class="alert alert-danger mt-2 js-fix-action-error" style="display: none">Action Error</p>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">No failures for this type.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    @include('admin.import.failures.includes.scripts')
@endsection
