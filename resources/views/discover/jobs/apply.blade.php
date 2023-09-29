@extends('layouts.app')

@section('content')
    @include('navbars.primary')

    <div class="container py-5">
        <div class="d-md-flex align-items-end justify-content-between mb-2">
            <h1 class="mb-0 text-accent">Apply Now</h1>
            <a href="{{ route('discover.jobs.show', $job->slug) }}">
                <i class="fal fa-long-arrow-left me-1"></i><span>Back to Job Listing</span>
            </a>
        </div>

        <div class="h4">
            {{ $job->job_title }} at <a href="{{ $job->ownerShowUrl }}">{{ $job->owner->name }}</a>
        </div>

        <div class="fs-6 my-3">
            Upload your resume and cover letter below.<br>
            <strong class="text-danger">PDF files only, 3 MB or less</strong>
        </div>

        <div class="mt-4 pl-0 col-12 col-md-6 col-xl-4">
            <form action="{{ route('discover.jobs.applyProcess') }}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="job_id" value="{{ $job->id }}">

                <div class="mb-3">
                    <label for="resume" class="form-label fw-bold text-uppercase">Resume</label>
                    <input class="form-control" type="file" name="resume" id="resume">
                    @error('resume') <div class="text-danger small">Your resume is required</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="cover_letter" class="form-label fw-bold text-uppercase">Cover Letter</label>
                    <input class="form-control" type="file" name="cover_letter" id="cover_letter">
                    @error('cover_letter') <div class="text-danger small">Your cover letter is required</div> @enderror
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    @include('footers.full')

@endsection
