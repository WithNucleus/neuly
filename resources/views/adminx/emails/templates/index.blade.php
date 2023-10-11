@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1>Email Templates</h1>
        <livewire:admin.emails.templates.index />
        <div class="mt-5 px-4 py-3">
            <p class="h5 mb-0">Merge Fields</p>
            <table class="table table-borderless table-sm w-auto m-0">
                <tr>
                    <td class="ps-0"><code>{first_name}</code></td>
                    <td>User's first name</td>
                </tr>
                <tr>
                    <td class="ps-0"><code>{entity_name}</code></td>
                    <td>Name of the entity associated with the request</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
