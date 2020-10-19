@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')
    @include('navbars.primary')
    <div class="container-fluid">
        <div class="row">
            <main id="content-main" role="main" class="col-lg-10 col-xl-8 mx-auto">

                @include('discover.includes.status-messages')

                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3 shadow-sm">
                            <div class="card-body">
                                <h1 class="text-center text-primary page-title-default">Neuly Jobs Report</h1>
                                <p class="lead-smaller text-center">
                                    Please answer the following questions. The information provided may be included in our inaugural Psychedelics Industry Jobs Report.
                                    Links to your job offerings and/or website will be provided. Thank you for your participation!
                                </p>

                                <div class="row">
                                    <div class="col-lg-8 mx-auto mt-4 border-top py-4">

                                        <form method="post" action="{{ route('job-report-entry.store') }}" style="max-width: 600px;" class="mx-auto">
                                            @csrf

                                            <div class="form-group">
                                                <label class="font-weight-bold">Name <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="name"
                                                       value="{{ Auth::check() ? Auth::user()->name . ' ' . Auth::user()->last_name : old('name') }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Email <span class="text-danger">*</span></label>
                                                <input class="form-control" type="email" name="email"
                                                       value="{{ Auth::check() ? Auth::user()->email : old('email') }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Company <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="company" value="{{ old('company') }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Position <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="position" value="{{ old('position') }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="d-block font-weight-bold">Are you currently hiring? <span class="text-danger">*</span></label>
                                                @foreach($currentlyHiring as $value => $label)
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input js-radio-with-additional-input"
                                                               type="radio" name="currently_hiring"
                                                               id="currently_hiring{{ $loop->index }}"
                                                               value="{{ $value }}"
                                                               data-show="{{ $value === \App\Models\JobReportEntry::CURRENTLY_HIRING_YES }}"
                                                               data-target=".js-currently-hiring-details-wrapper"
                                                                {{ old('currently_hiring') === $value ? 'checked' : '' }}
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="currently_hiring{{ $loop->index }}">{{ $label }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <hr>

                                            <div class="js-currently-hiring-details-wrapper" style="display: none">
                                                <div class="form-group">
                                                    <label class="d-block font-weight-bold">If you are hiring, where can we find the job listings?</label>
                                                    @foreach($jobListingSources as $value)
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" type="radio"
                                                                   name="job_listing_src"
                                                                   id="job_listing_src{{ $loop->index }}"
                                                                   value="{{ $value }}"
                                                                {{ old('job_listing_src') === $value ? 'checked' : '' }}>
                                                            <label class="custom-control-label"
                                                                   for="job_listing_src{{ $loop->index }}">{{ $value }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="form-group">
                                                    <label class="font-weight-bold">Please provide the URL(s) to your job listings</label>
                                                    <input class="form-control" type="text" name="job_listing_url"
                                                           value="{{ old('job_listing_url') }}">
                                                    <small>The information provided will be added to our Neuly database
                                                        and will become available to the public.</small>
                                                </div>
                                                <hr>
                                            </div>

                                            <div class="form-group">
                                                <label class="d-block font-weight-bold">How many employees does your company current have? <span class="text-danger">*</span></label>
                                                <select class="form-control" name="total_employees">
                                                @foreach($totalEmployees as $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="d-block font-weight-bold">What Role is most important for you to fill today?</label>
                                                @foreach($mostImportantRoles as $value)
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input js-radio-with-additional-input" type="radio"
                                                               name="most_important_role"
                                                               id="most_important_role{{ $loop->index }}"
                                                               value="{{ $value }}"
                                                            {{ old('most_important_role') === $value ? 'checked' : '' }}
                                                               data-show="{{ strtolower($value) == 'other' ? 1 : 0 }}"
                                                                data-target=".js-most-important-role-other">
                                                        <label class="custom-control-label"
                                                               for="most_important_role{{ $loop->index }}">{{ $value }}</label>
                                                    </div>
                                                @endforeach
                                                <div class="js-most-important-role-other" style="display: none;">
                                                    <input class="form-control" type="text" name="most_important_role_other"
                                                           value="{{ old('most_important_role_other') }}"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="d-block font-weight-bold">What, if anything, is currently holding you back from expanding your workforce?</label>
                                                @foreach($holdingFromExpanding as $value)
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input js-radio-with-additional-input" type="radio"
                                                               name="holding_from_expanding"
                                                               id="holding_from_expanding{{ $loop->index }}"
                                                               value="{{ $value }}"
                                                               {{ old('holding_from_expanding') === $value ? 'checked' : '' }}
                                                               data-show="{{ strtolower($value) == 'other' ? 1 : 0 }}"
                                                               data-target=".js-holding-from-expanding-other">
                                                        <label class="custom-control-label"
                                                               for="holding_from_expanding{{ $loop->index }}">{{ $value }}</label>
                                                    </div>
                                                @endforeach
                                                <div class="js-holding-from-expanding-other" style="display: none;">
                                                    <input class="form-control" type="text" name="holding_from_expanding_other"
                                                       value="{{ old('most_important_role_other') }}"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="d-block font-weight-bold">What is your 12-24 month forecast concerning psychedelic industry job growth?</label>
                                                @foreach($jobGrowthForecast as $value)
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input js-radio-with-additional-input" type="radio"
                                                               name="job_growth_forecast"
                                                               id="job_growth_forecast{{ $loop->index }}"
                                                               value="{{ $value }}"
                                                               {{ old('holding_from_expanding') === $value ? 'checked' : '' }}
                                                               data-show="{{ strtolower($value) == 'other' ? 1 : 0 }}"
                                                               data-target=".js-job-growth-forecast-other">
                                                        <label class="custom-control-label"
                                                               for="job_growth_forecast{{ $loop->index }}">{{ $value }}</label>
                                                    </div>
                                                @endforeach
                                                <div class="js-job-growth-forecast-other" style="display: none;">
                                                    <input class="form-control" type="text" name="job_growth_forecast_other"
                                                           value="{{ old('job_growth_forecast_other') }}"/>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                @include('footers.mini')
            </main>
        </div>
    </div>

    <script>
        $(function () {
            $('.js-radio-with-additional-input').on('change', function () {
                let needToShow = $(this).data('show'),
                    showTarget = $(this).data('target');

                if (needToShow === 1) {
                    $(showTarget).show();
                    $(showTarget).find('input').attr('disabled', false);
                } else {
                    $(showTarget).hide();
                    $(showTarget).find('input').attr('disabled', true);
                }
            });
        });
    </script>
@endsection
