<div class="container-fluid my-5 text-center">
    <h1 class="mb-3">{{ $title }}</h1>
    <div class="max-width-840 text-start mx-auto">
        @include('navbars.tabs-user-settings')

        <div class="bg-body p-3 p-md-4 p-lg-5">
            @include('members.includes.status-messages')
            <div class="lead">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
