@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <livewire:admin.emails.email-campaigns.manage-campaign :emailCampaign="$campaign" />
    </div>
@endsection
