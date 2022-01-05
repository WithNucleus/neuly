<div class="modal fade" id="edit-nav-item-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="edit-nav-item-{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-nav-item-{{ $item->id }}">Editing {{ $item->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('admin.nav-tiles.items.edit-item-form')
            </div>
        </div>
    </div>
</div>
