@if ($navigationTile->navItems->count() > 0)
    <div class="d-flex align-items-center justify-content-between mb-2">
        <h2 class="h5 mb-0">Nav Items <small class="ml-2">(drag to reorder)</small></h2>
        <button class="btn btn-sm btn-primary js-save-link-order" data-action="{{ route('admin.nav-tiles.items.reorder', $navigationTile->id) }}">Save Order</button>
    </div>

    @if(Session::has('navItemsSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('navItemsSuccess') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="alert js-ajax-response position-relative" style="display: none;">
        <span class="message"></span>
        <button type="button" class="close" data-hide="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

    <div class="alert alert-secondary js-list-updated-message position-relative" style="display: none;">
        You sorted something. Don't forget to save!
        <button type="button" class="close" data-hide="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

    <ol id="sortable-links">
        @foreach($navigationTile->navItems as $item)
            <li class="nav-tile-item" data-nav-link-id="{{ $item->id }}">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="{{ $item->type }}">
                        @if($item->url == '')
                            {{ $item->name }}
                        @else
                            <a href="{{ $item->url }}">{{ $item->name }}</a>
                        @endif
                    </span>
                    @if ($item->badge != '')
                        <span class="badge badge-info">{{ $item->badge }}</span>
                    @endif
                    <div class="ml-2">
                        <button class="btn btn-sm" data-toggle="modal" data-target="#edit-nav-item-{{ $item->id }}">
                            <i class="fad fa-edit text-secondarydark"></i>
                        </button>
                        <button class="btn btn-sm delete-nav-tile-item" data-delete="{{ $item->id }}" data-action="{{ route('admin.nav-tiles.items.delete', $item->id) }}">
                            <i class="fad fa-trash-alt text-danger"></i>
                        </button>
                    </div>
                </div>
            </li>
            @include('admin.nav-tiles.items.edit-item-modal')
        @endforeach
    </ol>
@endif
