@extends('layouts.app')

@section('body-class', 'page-neuly-edu bg-body-secondary')

@section('head')
    @livewireStyles
@endsection

@section('content')

    @include('navbars.primary')

    <main role="main" class="main-content-container pt-0">

        <div class="py-4 py-xl-5 px-3 text-center">
            <div class="max-width-400 mx-auto mb-4">
                @include('navbars.neuly-edu-logo')
            </div>
            <h1 class="text-transform-none text-center mb-0 max-width-780 mx-auto">
                All the educational content on psychedelics, etc. heading
            </h1>
        </div>

        <div id="neuly-edu-listings">
            <livewire:public.featured.neuly-edu-courses />
        </div>

    </main>

    @include('footers.full')
@endsection

@section('livewire_scripts')
    <script>
        Livewire.on('gotoTop', () => {
            document.querySelector('#neuly-edu-listings').scrollIntoView()
        });
    </script>
@endsection
