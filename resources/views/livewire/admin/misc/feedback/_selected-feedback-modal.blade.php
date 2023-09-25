@if($selectedFeedback)
    <div class="modal-header align-items-center">
        <div class="h5 modal-title">{{ $selectedFeedback->title }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body p-4">
        <div class="row">
            <div class="col-12 col-lg-6 mb-4">
                <div class="fw-bold text-uppercase text-primary">Date</div>
                <div>{{ \Carbon\Carbon::parse($selectedFeedback->created_at)->format('M d, Y H:i') }}</div>
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <div class="fw-bold text-uppercase text-primary">Status</div>
                <div class="lead">
                    <span class="badge fw-normal text-uppercase {{ $selectedFeedback->status_color }}">{{ $selectedFeedback->status }}</span>
                </div>
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <div class="fw-bold text-uppercase text-primary">Type</div>
                <div>{{ $selectedFeedback->type }}</div>
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <div class="fw-bold text-uppercase text-primary">User</div>
                <table class="table table-sm table-borderless w-auto align-middle">
                    <tbody>
                        <tr>
                            <th class="ps-0 text-uppercase small">Name:</th>
                            <td>
                                @if($selectedFeedback->user)
                                    <span>{{ $selectedFeedback->user->fullname }}</span>
                                    <span class="opacity-50">#{{ $selectedFeedback->user->id }}</span>
                                @else
                                    <span>{{ $selectedFeedback->user_name }}</span>
                                    <span class="opacity-50 small">(unregistered)</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="ps-0 text-uppercase small">Email:</th>
                            <td>
                                @if($selectedFeedback->user)
                                    <a href="mailto:{{ $selectedFeedback->user->email }}">{{ $selectedFeedback->user->email }}</a>
                                @else
                                    <a href="mailto:{{ $selectedFeedback->user_email }}">{{ $selectedFeedback->user_email }}</a>
                                @endif
                            </td>
                        </tr>
                        @isset($selectedFeedback->data['phone'])
                            <tr>
                                <th class="ps-0 text-uppercase small">Phone:</th>
                                <td>
                                    <a href="tel:{{ $selectedFeedback->data['phone'] }}">{{ $selectedFeedback->data['phone'] }}</a>
                                </td>
                            </tr>
                        @endisset
                        @isset($selectedFeedback->data['ip'])
                            <tr>
                                <th class="ps-0 text-uppercase small">IP:</th>
                                <td>{{ $selectedFeedback->data['ip'] }}</td>
                            </tr>
                        @endisset
                    </tbody>
                </table>
            </div>

            @isset($selectedFeedback->data['locations'])
                <div class="col-12 col-lg-6 mb-4">
                    <div class="fw-bold text-uppercase text-primary">Location</div>
                    <div>
                        {{ $selectedFeedback->data['locations']['local']['name'] }}
                    </div>
                    <div class="small">
                        @isset($selectedFeedback->data['locations']['local'])
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $selectedFeedback->data['locations']['local']['latitude'] }},{{ $selectedFeedback->data['locations']['local']['longitude'] }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                                {{ $selectedFeedback->data['locations']['local']['latitude'] }}, {{ $selectedFeedback->data['locations']['local']['longitude'] }}
                            </a>
                        @endisset
                    </div>
                </div>
            @endisset

            @if($selectedFeedback->organization)
                <div class="col-12 col-lg-6 mb-4">
                    <div class="fw-bold text-uppercase text-primary">Organization</div>
                    <div>{{ $selectedFeedback->organization }}</div>
                </div>
            @endif
            @if($selectedFeedback->job_title)
                <div class="col-12 col-lg-6 mb-4">
                    <div class="fw-bold text-uppercase text-primary">Job Title</div>
                    <div>{{ $selectedFeedback->job_title }}</div>
                </div>
            @endif
        </div>
        <div class="fw-bold text-uppercase text-primary">Message</div>
        <div>{{ $selectedFeedback->content }}</div>

        <div class="mt-5 border-top">
            <div class="d-flex flex-wrap align-items-center justify-content-center">
                @foreach($statusActionOptions as $status => $details)
                    @if($selectedFeedback->status !== $status)
                        <button wire:click="changeStatus('{{ $status }}')" class="btn btn-{{ $details['button'] }} m-3">{{ $details['label'] }}</button>
                    @endif
                @endforeach
            </div>
            @if($selectedFeedback->status !== \App\Models\Feedback::STATUS_CLOSED)
                <div class="d-flex justify-content-center">
                    <div class="d-flex align-items-center mt-2">
                        <label for="assignUser" class="text-uppercase fw-bold me-2 text-nowrap">Assigned to</label>
                        <select wire:model="assignedUser" id="assignUser" class="form-select form-select-sm me-2">
                            <option value=""></option>
                            @foreach($internalUsers as $user)
                                <option value="{{ $user->id }}">{{ $user->id }} {{ $user->full_name }}</option>
                            @endforeach
                        </select>
                        <button wire:click="assignFeedback" class="btn btn-sm btn-dark">Save</button>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif
