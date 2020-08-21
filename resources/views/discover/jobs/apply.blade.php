@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => false])

        <div class="page-title-default d-md-flex align-items-end justify-content-between mb-2">
            <h1 class="mb-0">Apply Now</h1>

            <a href="{{ route('discover.jobs.show', $job->slug) }}"><small><i class="fal fa-long-arrow-left mr-1"></i>Back to Job Listing</small></a>
        </div>

        <p class="lead mb-2">
            {{ $job->job_title }} at <a href="{{ route('discover.organizations.show', $job->company->slug) }}">{{ $job->company->name }}</a>
        </p>

        <div class="form-group">
            <p class="mb-0">
                Upload your resume and cover letter below.<br>
                <strong class="text-danger">PDF files only, 3 MB or less</strong>
            </p>
        </div>

        @include('discover.includes.status-messages')

        <div class="mt-4 pl-0 col-12 col-md-6 col-xl-4">
            <form action="{{ route('discover.jobs.applyProcess') }}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="job_id" value="{{ $job->id }}">
                <input type="hidden" name="company_id" value="{{ $job->company->id }}">

                <div class="form-group">
                    <label for="resume" class="font-weight-bold">Resume</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="resume" id="resume" required>
                        <label class="custom-file-label" for="resume">Choose file</label>
                    </div>
                    <div class="invalid-feedback">
                        Your resume is required.
                    </div>
                </div>
                <div class="form-group">
                    <label for="cover_letter" class="font-weight-bold">Cover Letter</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="cover_letter" id="cover_letter" required>
                        <label class="custom-file-label" for="cover_letter">Choose file</label>
                    </div>
                    <div class="invalid-feedback">
                        Your cover letter is required.
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();

            /* Show File Names After Selection */
            document.querySelector('#resume').addEventListener('change',function(e){
                var fileName = document.getElementById(this.id).files[0].name;
                var nextSibling = e.target.nextElementSibling
                nextSibling.innerText = fileName
            });

            document.querySelector('#cover_letter').addEventListener('change',function(e){
                var fileName = document.getElementById(this.id).files[0].name;
                var nextSibling = e.target.nextElementSibling
                nextSibling.innerText = fileName
            });

        </script>

    @include('discover.includes.show-end')

@endsection
