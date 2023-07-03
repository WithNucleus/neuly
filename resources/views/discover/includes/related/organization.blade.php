@if(count($related) > 0)
    <h4 class="mt-5">Related Organizations:</h4>
    <div class="row pt-3">
        @foreach($related as $item)
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <x-entities.entity-logo-card url="{{ route('discover.organizations.show', $item->slug) }}">
                    <div class="logo-is-contained" style="background-image: url('{{ $item->entityImageUrl ?? asset('images/image-placeholder.jpg') }}');"></div>
                    <p class="fw-bold text-uppercase m-0">{{ $item->name }}</p>
                </x-entities.entity-logo-card>
            </div>
        @endforeach
    </div>
@endif
