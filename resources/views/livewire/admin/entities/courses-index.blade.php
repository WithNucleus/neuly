<div>
    <div class="table-entity-index-container table-responsive">
        <table class="table small">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Delivery Method</th>
                    <th>Cost</th>
                    <th>Currency</th>
                    <th>Credits</th>
                    <th>Hours</th>
                    <th>Dates</th>
                    <th>Open Enrollment</th>
                    <th>Self Paced</th>
                    <th>Length</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $record)
                    <tr wire:key="record-{{ $record->slug }}">
                        <td>
                            <div class="truncate-300">
                                <a href="{{ route('discover.courses.show', $record->slug) }}">{{ $record->name }}</a>
                            </div>
                        </td>
                        <td class="text-nowrap">{{ $record->type }}</td>
                        <td class="text-nowrap">{{ $record->learning_location }}</td>
                        <td class="text-nowrap">{{ $record->delivery_method }}</td>
                        <td class="text-nowrap">
                            @if($record->lowest_cost)
                                <span>{{ $record->lowest_cost }}</span>
                            @endif
                            @if($record->lowest_cost AND $record->highest_cost)
                                <span>&ndash;</span>
                            @endif
                            @if($record->highest_cost)
                                <span>{{ $record->highest_cost }}</span>
                            @endif
                        </td>
                        <td class="text-nowrap">{{ $record->currency }}</td>
                        <td class="text-nowrap">{{ $record->education_credits }}</td>
                        <td class="text-nowrap">{{ $record->hours }}</td>
                        <td class="text-nowrap">
                            @if($record->next_date)
                                <div>
                                    <strong>Start:</strong>
                                    <span>{{ $record->next_date }}</span>
                                </div>
                            @endif
                            @if($record->finish_date)
                                <div>
                                    <strong>Finish:</strong>
                                    <span>{{ $record->finish_date }}</span>
                                </div>
                            @endif
                            @if($record->next_date_string)
                                <div>
                                    <strong>Starting</strong>
                                    <span>{{ $record->next_date_string }}</span>
                                </div>
                            @endif
                        </td>
                        <td class="text-nowrap">
                            @if($record->open_enrollment === 1)
                                <span>Yes</span>
                            @endif
                        </td>
                        <td class="text-nowrap">
                            @if($record->self_paced === 1)
                                <span>Yes</span>
                            @endif
                        </td>
                        <td class="text-nowrap">{{ $record->length }}</td>
                        <td>{{ $record->image }}</td>
                    </tr>
                @empty
                    <tr wire:key="empty-no-records">
                        <td>No records match your query</td>
                    </tr>
                 @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-5">
        {{ $records->links() }}
    </div>
</div>
