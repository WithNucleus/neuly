@if($selectedRecord)
    <div class="modal-header align-items-center">
        <div class="h5 modal-title">{{ $selectedRecord->name }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body p-4">
        <div class="row">
            <div class="col-12 col-lg-6 mb-4">
                <div class="fw-bold text-uppercase text-primary">Date</div>
                <div>{{ \Carbon\Carbon::parse($selectedRecord->created_at)->format('M d, Y H:i') }}</div>
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <div class="fw-bold text-uppercase text-primary">Status</div>
                <div class="lead">
                    <span class="badge fw-normal text-uppercase {{ $selectedRecord->status_color }}">{{ $selectedRecord->status }}</span>
                </div>
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <div class="fw-bold text-uppercase text-primary">Type</div>
                <div>{{ $selectedRecord->type }}</div>
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <div class="fw-bold text-uppercase text-primary">User</div>
                <table class="table table-sm table-borderless w-auto align-middle">
                    <tbody>
                        <tr>
                            <th class="ps-0 text-uppercase small">Name:</th>
                            <td>
                                @if($selectedRecord->user)
                                    <span>{{ $selectedRecord->user->fullname }}</span>
                                    <span class="opacity-50">#{{ $selectedRecord->user->id }}</span>
                                @else
                                    <span>{{ $selectedRecord->name }}</span>
                                    <span class="opacity-50 small">(unregistered)</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="ps-0 text-uppercase small">Email:</th>
                            <td>
                                @if($selectedRecord->user)
                                    <a href="mailto:{{ $selectedRecord->user->email }}">{{ $selectedRecord->user->email }}</a>
                                @else
                                    <a href="mailto:{{ $selectedRecord->email }}">{{ $selectedRecord->email }}</a>
                                @endif
                            </td>
                        </tr>
                        @isset($selectedRecord->phone)
                            <tr>
                                <th class="ps-0 text-uppercase small">Phone:</th>
                                <td>
                                    <a href="tel:{{ $selectedRecord->phone }}">{{ $selectedRecord->phone }}</a>
                                </td>
                            </tr>
                        @endisset
                        @isset($selectedRecord->ip)
                            <tr>
                                <th class="ps-0 text-uppercase small">IP:</th>
                                <td>{{ $selectedRecord->ip }}</td>
                            </tr>
                        @endisset
                        @isset($selectedRecord->data['age'])
                            <tr>
                                <th class="ps-0 text-uppercase small">Age:</th>
                                <td>{{ $selectedRecord->data['age'] }}</td>
                            </tr>
                        @endisset
                        @isset($selectedRecord->data['age'])
                            <tr>
                                <th class="ps-0 text-uppercase small">Sex:</th>
                                <td>{{ $selectedRecord->data['sex'] }}</td>
                            </tr>
                        @endisset
                    </tbody>
                </table>
                @isset($selectedRecord->data['open_to_trials'])
                    <div class="small text-uppercase">
                        @if($selectedRecord->data['open_to_trials'] === true)
                            <span class="text-success fw-bold">Interested in other trials</span>
                        @else
                            <span class="text-danger fw-bold">Only interested in this trial</span>
                        @endif
                    </div>
                @endisset
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <div class="fw-bold text-uppercase text-primary">Location</div>
                @isset($selectedRecord->data['locations'])
                    <div>
                        {{ $selectedRecord->data['locations']['local']['name'] }}
                    </div>
                    <div class="small">
                        @isset($selectedRecord->data['locations']['local'])
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $selectedRecord->data['locations']['local']['latitude'] }},{{ $selectedRecord->data['locations']['local']['longitude'] }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                                {{ $selectedRecord->data['locations']['local']['latitude'] }}, {{ $selectedRecord->data['locations']['local']['longitude'] }}
                            </a>
                        @endisset
                    </div>
                @endisset
            </div>
        </div>
        <div class="fw-bold text-uppercase text-primary">Message</div>
        <div>{{ $selectedRecord->message }}</div>

        <div class="mt-5 border-top">
            <div class="d-flex flex-wrap align-items-center justify-content-center">
                @foreach($statusActionOptions as $status => $details)
                    @if($selectedRecord->status !== $status)
                        <button wire:click="changeStatus('{{ $status }}')" class="btn btn-{{ $details['button'] }} m-3">{{ $details['label'] }}</button>
                    @endif
                @endforeach
            </div>
            @if($selectedRecord->status !== \App\Models\Feedback::STATUS_CLOSED)
                <div class="d-flex justify-content-center">
                    <div class="d-flex align-items-center mt-2">
                        <label for="assignUser" class="text-uppercase fw-bold me-2 text-nowrap">Assigned to</label>
                        <select wire:model="assignedUser" id="assignUser" class="form-select form-select-sm me-2">
                            <option value=""></option>
                            @foreach($internalUsers as $user)
                                <option value="{{ $user->id }}">{{ $user->id }} {{ $user->full_name }}</option>
                            @endforeach
                        </select>
                        <button wire:click="assignRecord" class="btn btn-sm btn-dark">Save</button>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif
