<ul class="list-group list-group-flush mb-4 border">
    @foreach($companies as $company)
        <li class="list-group-item">
            <p class="font-weight-bold mb-1">
                <span class="text-lg-left mr-2">{{ $company->clinicaltrials_count }}</span>
                <a href="{{ route('discover.organizations.show', $company->slug) }}">{{ $company->name }}</a>
            </p>
        </li>
    @endforeach
</ul>
