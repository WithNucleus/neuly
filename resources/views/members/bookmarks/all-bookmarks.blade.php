@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('members.includes.dashboard-begin')

    <div class="container-full">
        <div class="row">
            <div class="col-12">
                <div class="p-4 bg-white shadow-sm">
                    <h1 class="h2"><i class="fad fa-clipboard-list text-info"></i> All Bookmarks</h1>

                    @if ($bookmarks->count() > 0)
                        <table id="index" class="primary-index-table table table-sm" data-toggle="table">
                            <thead>
                                <tr>
                                    <th data-field="image">
                                        Entity
                                    </th>
                                    <th data-field="date">
                                        Date Added
                                    </th>
                                    <th data-field="name">
                                        Bookmark
                                    </th>
                                    <th class="list">
                                        List
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookmarks as $bookmark)
                                    @php
                                    $bookmark_link = $bookmark->slug($bookmark->entity, $bookmark->entity_id);
                                    @endphp
                                    <tr>
                                        <td class="image">
                                            <div class="bookmark-image">
                                                <img src="{{ asset('images/icons/' . $bookmark->entity . '.svg') }}" alt="{{ $bookmark->name }}">
                                            </div>
                                            <span class="font-size-small">
                                                {{ ucfirst($bookmark->entity) }}
                                            </span>
                                        </td>
                                        <td class="date">
                                            {{ Carbon\Carbon::parse($bookmark->created_at)->format('M, d, Y') }}
                                        </td>
                                        <td class="name">
                                            <span class="truncate-this d-block">
                                                <a href="{{ route($bookmark_link['route'], $bookmark_link['slug']) }}" class="font-weight-bold d-block">{{ $bookmark->name }}</a>
                                            </span>
                                            @if ($bookmark->notes !== '')
                                                <span class="truncate-this d-block">{{ $bookmark->notes }}</span>
                                            @endif
                                        </td>
                                        <td class="list">
                                            <a href="{{ route('member.bookmarks.show-list', $bookmark->list->slug) }}" class="text-decoration-none text-dark font-weight-bold">
                                                <i class="fad fa-list-alt"></i> {{ $bookmark->list->name }}
                                            </a>
                                        </td>                                    
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th id="image-search">Company Name</th>
                                    <th id="date-search">Focus</th>
                                    <th id="name-search">Type</th>
                                    <th id="notes-search">Location</th>
                                    <th id="list-search">Meta</th>
                                </tr>
                            </tfoot>
                        </table>
                    @else
                        <p>You don't have any bookmarks yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('members.includes.dashboard-end')

@endsection
