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
        <div class="col-12 col-md-6">
            <div class="card card-body">
                <h3 class="h4">Failures of Sponsor/Collaborators</h3>
                <ul class="list-group">
                    @forelse($failures as $failure)
                        <li class="list-group-item js-failure-item-container">
                            @foreach ($failure->details as $key => $detail)
                                <p>{{ strtoupper($key) }} : {{ $detail }}</p>
                            @endforeach
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-success js-fix-sponsor-failure-button"
                                            data-model="{{ \App\Models\Company::class }}"
                                            data-action="{{ route('import.failures.fix', $failure->id) }}">Create as Organization and attach
                                    </button>

                                    <p class="h5 mt-4">Or attach to existing organization</p>
                                    <div class="form-group">
                                        <label for="company" class="font-weight-bold"><span class="text-danger">*</span>Search organization:</label><br>
                                        <input id="company" type="text"
                                               class="form-control js-fix-sponsor-failure-search-company-input"
                                               data-action="{{ route('admin.entityMerge.getEntityListJson') }}"
                                               data-entity-type="{{ \App\Helpers\EntityHelper::getAliasByClass(\App\Models\Company::class) }}"
                                               autocomplete="false" name="company" value="" disabled="disabled"/>

                                        <input type="hidden" name="company_id" class="js-company-id-input" value=""/>
                                        <br>
                                        <button class="btn btn-primary mt-2 js-fix-sponsor-failure-attach-company-button"
                                                data-model="{{ \App\Models\Company::class }}"
                                                data-action="{{ route('import.failures.fix', $failure->id) }}">Attach organization
                                        </button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <button class="btn btn-success js-fix-sponsor-failure-button"
                                            data-model="{{ \App\Models\Person::class }}"
                                            data-action="{{ route('import.failures.fix', $failure->id) }}">Create as Person and attach
                                    </button>

                                    <p class="h5 mt-4">Or attach to existing person</p>
                                    <div class="form-group">
                                        <label for="person" class="font-weight-bold"><span class="text-danger">*</span>Search person:</label><br>
                                        <input id="person" type="text"
                                               class="form-control js-fix-sponsor-failure-search-person-input"
                                               data-action="{{ route('admin.entityMerge.getEntityListJson') }}"
                                               data-entity-type="{{ \App\Helpers\EntityHelper::getAliasByClass(\App\Models\Person::class) }}"
                                               autocomplete="false" name="person" value="" disabled="disabled"/>

                                        <input type="hidden" name="person_id" class="js-person-id-input" value=""/>
                                        <br>
                                        <button class="btn btn-primary mt-2 js-fix-sponsor-failure-attach-person-button"
                                                data-model="{{ \App\Models\Person::class }}"
                                                data-action="{{ route('import.failures.fix', $failure->id) }}">Attach person
                                        </button>
                                    </div>

                                </div>
                            </div>

                            <button class="btn btn-danger mt-4 js-delete-failure-button"
                                    data-action="{{ route('import.failures.delete', $failure->id) }}">Delete failure
                            </button>

                            <p class="alert alert-danger mt-2 js-fix-action-error" style="display: none;">Action Error</p>
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
