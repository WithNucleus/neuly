@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">

        <h1 class="mb-5">Email Template: {{ $email->emailTemplate->name }}</h1>

        <table class="table-borderless w-auto fs-6 align-top">
            <tr>
                <th class="min-width-110 text-uppercase ps-0 pe-3 text-end pb-2">Status:</th>
                <td class="pb-2">
                    <span class="badge text-uppercase {{ $email->status_color }}">{{ $email->status }}</span>
                </td>
            </tr>
            @if($email->response)
                <tr>
                    <th class="min-width-110 text-uppercase ps-0 pe-3 text-end pb-2">Response:</th>
                    <td>
                        @foreach($email->response as $label => $reason)
                            <div class="small mb-2">
                                <span>{{ $label }} &ndash;</span>
                                <span>{{ $reason }}</span>
                            </div>
                        @endforeach
                    </td>
                </tr>
            @endif
            <tr>
                <th class="min-width-110 text-uppercase ps-0 pe-3 text-end pb-2">Date:</th>
                <td class="pb-2">
                    @if($email->sent_at)
                        <span>Sent at {{ $email->sent_at }}</span>
                    @else
                        <span>Scheduled for {{ \Carbon\Carbon::parse($email->send_at)->diffForHumans() }}</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th class="min-width-110 text-uppercase ps-0 pe-3 text-end pb-2">From:</th>
                <td class="pb-2">
                    <span>{{ $email->from_name }}</span>
                    <span class="text-body-tertiary">{{ $email->from_email }}</span>
                </td>
            </tr>
            <tr>
                <th class="min-width-110 text-uppercase ps-0 pe-3 text-end pb-2">To:</th>
                <td class="pb-2">
                    <span>{{ $email->to_name }}</span>
                    <span class="text-body-tertiary">{{ $email->to_email }}</span>
                </td>
            </tr>
            <tr>
                <th class="min-width-110 text-uppercase ps-0 pe-3 text-end">Subject:</th>
                <td>{{ $email->subject }}</td>
            </tr>
        </table>

        <div class="mt-4">
            <div class="d-lg-flex">
                <div class="fs-6 text-uppercase fw-bold min-width-110">Body:</div>
                <div class="flex-grow-1 pt-1 max-width-780">{!! $email->body !!}</div>
            </div>
        </div>
    </div>
@endsection
