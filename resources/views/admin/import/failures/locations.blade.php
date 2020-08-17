@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Import</span>
            <a href="{{ route('import.failures', $importResultId) }}" class="font-sm"><i
                    class="la la-angle-double-left"></i> Back to
                <span>Import failures</span></a>
        </h2>
    </div>
@endsection

@section('content')
    <div class="row mt-1">
        <div class="col-12 col-md-6">
            <div class="card card-body">
                <h3 class="h4">Failures of Locations</h3>
                <ul class="list-group">
                    @forelse($failures as $failure)
                        <li class="list-group-item">
                            @foreach ($failure->details as $key => $detail)
                                <p>{{ strtoupper($key) }} : {{ $detail }}</p>
                            @endforeach
                            <div class="form-group">
                                <label class="font-weight-bold">*Country:</label>
                                <input type="text" class="form-control" name="country">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">*Region:</label>
                                <input type="text" class="form-control" name="region">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">City:</label>
                                <input type="text" class="form-control" name="city">
                            </div>
                            <button class="btn btn-primary js-fix-location-failure-button"
                                    data-model="{{ \App\Models\Location::class }}"
                                    data-action="{{ route('import.failures.fix', $failure->id) }}">Add to Locations
                            </button>
                            <p class="alert alert-danger mt-2 d-none">Unknown Error</p>
                        </li>
                    @empty
                        <li class="list-group-item">No failures for this type.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        $(".js-fix-location-failure-button").on('click', function () {
            let errors = false,
                button = $(this),
                itemBlock = button.parent(),
                action = button.data('action'),
                model = button.data('model'),
                countryInput = itemBlock.find('input[name=country]'),
                regionInput = itemBlock.find('input[name=region]'),
                cityInput = itemBlock.find('input[name=city]'),
                country = countryInput.val().trim(),
                region = regionInput.val().trim(),
                city = cityInput.val().trim();

            countryInput.removeClass('is-invalid');
            regionInput.removeClass('is-invalid');

            if (country === '') {
                errors = true;
                countryInput.addClass('is-invalid');
            }

            if (region === '') {
                errors = true;
                regionInput.addClass('is-invalid');
            }

            if (errors === true) {
                return false;
            }

            let data = {
                'model'  : model,
                'country': country,
                'region' : region,
                'city'   : city
            };

            $.post(action, data, function (response){
                if (response.status == 'success') {
                    itemBlock.slideUp();
                } else {
                    itemBlock.find('.alert').removeClass('d-none');
                }
            });
        });
    </script>

@endsection
