<div class="d-md-flex flex-wrap justify-content-between mb-3">
    <h1 class="{{ $headingClasses ?? 'text-success mb-2 mb-md-0' }}">{{ urldecode($title) }}</h1>
    <div class="d-flex flex-wrap align-items-center">
        {{ $slot }}
    </div>
</div>
