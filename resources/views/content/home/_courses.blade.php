<div class="home-courses bg-body-secondary">
    <div class="container text-center">
        <h2 class="h1 text-body-emphasis max-width-740 mx-auto">Industry Courses That Can Launch Your Career</h2>
        <p class="lead max-width-600 mx-auto mb-5">Psychedelic-assisted therapy is slated to help millions. Therapists and sitters are needed.</p>
        <div class="row" data-masonry='{"percentPosition": true }'>
            @foreach($courses as $course)
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <a href="" class="card-hover-drop">
                        <div class="card h-100 border-0 rounded-3">
                            <img src="{{ $course->entity_image_url ?? asset('images/image-placeholder-course.png') }}" alt="{{ $course->name }}" class="card-img-top rounded-top-3">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <p class="lead text-body-emphasis mb-2">{{ $course->name }}</p>
                                    <p class="mb-0">{{ $course->very_short_summary }}</p>
                                </div>
                                <div>
                                    @foreach ($course->focus as $item)
                                        <span class="badge bg-body-tertiary text-body mt-2 mx-1">{{ $item->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="mt-4 text-center">
            <a href="{{ route('discover.courses') }}" class="btn btn-cta btn-primary btn-lg">View All Courses</a>
        </div>
    </div>
</div>
