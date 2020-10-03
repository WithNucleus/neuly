<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="text-center">Clinical Trials by Focus</h3>
        <div class="mx-auto" style="max-width: 480px;">
            <div class="focus-list">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <th scope="col">Name</th>
                        <th scope="col">Clinical Trials</th>
                    </thead>
                    <tbody class="focus-body">

                    </tbody>
                </table>
            </div>
            {{-- <a href="{{ route('insights.most-interest.show') }}">Show all Focus</a>--}}
            <p class="text-center mb-0">
                <a href="{{ route('discover.clinicaltrials') }}" class="btn btn-sm btn-dark">Explore Clinical Trials</a>
            </p>
        </div>
    </div>
</div>

