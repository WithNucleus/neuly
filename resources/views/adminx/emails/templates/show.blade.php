@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <h1 class="mb-5">Email Template: {{ $template->name }}</h1>

        <table class="table-borderless w-auto fs-6 align-top">
            <tr>
                <th class="min-width-110 text-uppercase ps-0 pe-3 text-end">From:</th>
                <td>
                    <span>{{ $template->from_name }}</span>
                    <span class="text-body-tertiary">{{ $template->from_email }}</span>
                </td>
            </tr>
            <tr>
                <th class="min-width-110 text-uppercase ps-0 pe-3 text-end">Subject:</th>
                <td>{{ $template->subject }}</td>
            </tr>
        </table>

        <div class="mt-4">
            <div class="d-lg-flex">
                <div class="fs-6 text-uppercase fw-bold min-width-110">Body:</div>
                <div class="flex-grow-1 pt-1 max-width-780">{!! $template->body !!}</div>
            </div>
        </div>
    </div>
@endsection
