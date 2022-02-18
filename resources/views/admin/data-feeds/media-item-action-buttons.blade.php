<div class="action-buttons-container d-flex align-items-center flex-wrap">

    <div class="approve-item-container d-flex align-items-center mr-5">
        <button class="approve-item btn btn-success mr-2 text-nowrap"
                data-url="{{ route('admin.media-dashboard.update', $item->id) }}"
                data-type="#media-item-{{ $item->id }}"
                data-parent="#item-{{ $item->id }}"
        >Approve as</button>
        <label for="media-item-{{ $item->id }}" class="sr-only">Approve as</label>
        <select id="media-item-{{ $item->id }}" class="form-control">
            @foreach (\App\Enum\MediaTypes::MEDIA_TYPES as $mediaType)
                <option value="{{ $mediaType }}" @if ($mediaType === $item->media_type) selected @endif>{{ $mediaType }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-warning mr-4 decline-item" data-parent="#item-{{ $item->id }}" data-url="{{ route('admin.media-dashboard.update', $item->id) }}">
        Decline
    </button>

</div>
