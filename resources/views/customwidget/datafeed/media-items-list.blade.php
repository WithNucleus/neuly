<div class="{{ $widget['class'] ?? 'well mb-2' }} mt-4 col-xl-8 p-0">
    <h3>Media Items</h3>
    <div class="card card-body flex-fill p-0">
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($widget['dataFeed']['mediaItems'] as $mediaItem)
                <tr>
                    <td style="white-space: nowrap">
                        {{ \Carbon\Carbon::parse($mediaItem->date)->format('M d, Y') }}
                    </td>
                    <td>
                        {{ $mediaItem->name }}
                    </td>
                    <td style="white-space: nowrap">
                        <a href="{{ route('admin.media-item.show', $mediaItem->id) }}" class="btn btn-sm btn-link"><i class="la la-eye"></i> Preview</a>
                        <a href="{{ $mediaItem->url }}" class="btn btn-sm btn-link" target="_blank" rel="noopener noreferrer">
                            <i class="la la-external-link"></i> Go to Media
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
