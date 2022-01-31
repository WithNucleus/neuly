@if ($entry->status === \App\Models\MediaItem::STATUS_PENDING)
    <div>
        <label for="media-action" class="sr-only">What are we doing with this?</label>
        <select id="media-action" name="media-action" class="custom-select custom-select-sm form-control form-control-sm">
            <option value="approve">Approve</option>
            <option value="decline">Decline</option>
        </select>
    </div>
@endif
