@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>Imported Course Results</h1>
        <div class="h3 text-success text-uppercase">
            {{ $importResult->formatted_created_at }}
        </div>
        <div>
            @foreach($importResult->company_messages as $companyName => $companyData)
                <div class="my-3">
                    <livewire:admin.import.courses.company-match wire:key="company-{{ \Illuminate\Support\Str::slug($companyName) }}" companyName="{{ $companyName }}" companyUrl="{{ $companyData['url'] }}" :courseIds="$companyData['courses']" :importResult="$importResult" />
                </div>
            @endforeach
        </div>
    </div>
@endsection
