<div class="{{ $classes ?? 'col-12 col-md-6 col-lg-4 mb-4' }}">
    <x-entities.entity-logo-card url="{{ route('discover.courses.show', $course->slug) }}" linkClasses="py-0">
        <div class="d-flex justify-content-between flex-column h-100">
            <div>
                <div class="logo-is-contained" style="background-image: url('{{ $course->companies->first()->entityImageUrl ?? asset('images/image-placeholder-edu.png') }}');"></div>
                <h3 class="h6 text-body-secondary mt-3">{{ $course->name }}</h3>
            </div>
            <div class="d-flex justify-content-between small mt-3 text-uppercase text-body">
                <div>{{ $course->type }}</div>
                <div>{{ $course->learning_location ?? $course->delivery_method }}</div>
            </div>
        </div>
    </x-entities.entity-logo-card>
</div>
