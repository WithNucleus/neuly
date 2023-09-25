@if($selectedStudent)
    <div class="modal-header align-items-center">
        <div class="h5 modal-title">{{ $selectedStudent->name }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body p-4">
        <div class="row">
            <div class="col-12 col-lg-6 mb-4">
                <div class="fw-bold text-uppercase text-primary">Date</div>
                <div>{{ \Carbon\Carbon::parse($selectedStudent->created_at)->format('M d, Y H:i') }}</div>
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <div class="fw-bold text-uppercase text-primary">Status</div>
                <div class="lead">
                    <span class="badge fw-normal text-uppercase {{ $selectedStudent->status_color }}">{{ $selectedStudent->status }}</span>
                </div>
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <div class="fw-bold text-uppercase text-primary">Type</div>
                <div>{{ $selectedStudent->type }}</div>
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <div class="fw-bold text-uppercase text-primary">User</div>
                <table class="table table-sm table-borderless w-auto align-middle">
                    <tbody>
                        <tr>
                            <th class="ps-0 text-uppercase small">Name:</th>
                            <td>
                                @if($selectedStudent->user)
                                    <span>{{ $selectedStudent->user->fullname }}</span>
                                    <span class="opacity-50">#{{ $selectedStudent->user->id }}</span>
                                @else
                                    <span>{{ $selectedStudent->name }}</span>
                                    <span class="opacity-50 small">(unregistered)</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="ps-0 text-uppercase small">Email:</th>
                            <td>
                                @if($selectedStudent->user)
                                    <a href="mailto:{{ $selectedStudent->user->email }}">{{ $selectedStudent->user->email }}</a>
                                @else
                                    <a href="mailto:{{ $selectedStudent->email }}">{{ $selectedStudent->email }}</a>
                                @endif
                            </td>
                        </tr>
                        @isset($selectedStudent->phone)
                            <tr>
                                <th class="ps-0 text-uppercase small">Phone:</th>
                                <td>
                                    <a href="tel:{{ $selectedStudent->phone }}">{{ $selectedStudent->phone }}</a>
                                </td>
                            </tr>
                        @endisset
                        @isset($selectedStudent->ip)
                            <tr>
                                <th class="ps-0 text-uppercase small">IP:</th>
                                <td>{{ $selectedStudent->ip }}</td>
                            </tr>
                        @endisset
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <div class="fw-bold text-uppercase text-primary">Location</div>
                @isset($selectedStudent->data['locations'])
                    <div>
                        {{ $selectedStudent->data['locations']['local']['name'] }}
                    </div>
                    <div class="small">
                        @isset($selectedStudent->data['locations']['local'])
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $selectedStudent->data['locations']['local']['latitude'] }},{{ $selectedStudent->data['locations']['local']['longitude'] }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                                {{ $selectedStudent->data['locations']['local']['latitude'] }}, {{ $selectedStudent->data['locations']['local']['longitude'] }}
                            </a>
                        @endisset
                    </div>
                @endisset
            </div>
            <div class="col-12 col-lg-6 mb-4">
                @isset($selectedStudent->data['filters'])
                    <div class="fw-bold text-uppercase text-primary">Search Intent</div>
                    <div class="row">
                        @if(!empty($selectedStudent->data['filters']['type']))
                            <div class="col-12 col-xl-6 small mb-2">
                                <div class="fw-bold text-uppercase">Type</div>
                                @foreach($selectedStudent->data['filters']['type'] as $item)
                                    <div>{{ $item }}</div>
                                @endforeach
                            </div>
                        @endif
                        @if(!empty($selectedStudent->data['filters']['focus']))
                            <div class="col-12 col-xl-6 small mb-2">
                                <div class="fw-bold text-uppercase">Focus</div>
                                @foreach($selectedStudent->data['filters']['focus'] as $item)
                                    <div>{{ $item }}</div>
                                @endforeach
                            </div>
                        @endif
                        @if(!empty($selectedStudent->data['filters']['delivery-method']))
                            <div class="col-12 col-xl-6 small mb-2">
                                <div class="fw-bold text-uppercase">Delivery Method</div>
                                @foreach($selectedStudent->data['filters']['delivery-method'] as $item)
                                    <div>{{ $item }}</div>
                                @endforeach
                            </div>
                        @endif
                        @if(!empty($selectedStudent->data['filters']['companies']))
                            <div class="col-12 col-xl-6 small mb-2">
                                <div class="fw-bold text-uppercase">Companies</div>
                                @foreach($selectedStudent->data['filters']['companies'] as $item)
                                    <div>{{ $item }}</div>
                                @endforeach
                            </div>
                        @endif
                        <div class="col-12 col-xl-6 small mb-2">
                            @if($selectedStudent->data['filters']['free'])
                                <div>
                                    <i class="fa-sharp fa-solid fa-square-check"></i>
                                    <span>Free</span>
                                </div>
                            @endif
                            @if($selectedStudent->data['filters']['self-paced'])
                                <div>
                                    <i class="fa-sharp fa-solid fa-square-check"></i>
                                    <span>Self Paced</span>
                                </div>
                            @endif
                            @if($selectedStudent->data['filters']['open-enrollment'])
                                <div>
                                    <i class="fa-sharp fa-solid fa-square-check"></i>
                                    <span>Open Enrollment</span>
                                </div>
                            @endif
                            @if($selectedStudent->data['filters']['education-credits'])
                                <div>
                                    <i class="fa-sharp fa-solid fa-square-check"></i>
                                    <span>Education Credits</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endisset
            </div>
        </div>
        <div class="fw-bold text-uppercase text-primary">Message</div>
        <div>{{ $selectedStudent->message }}</div>

        <div class="mt-5 border-top">
            <div class="d-flex flex-wrap align-items-center justify-content-center">
                @foreach($statusActionOptions as $status => $details)
                    @if($selectedStudent->status !== $status)
                        <button wire:click="changeStatus('{{ $status }}')" class="btn btn-{{ $details['button'] }} m-3">{{ $details['label'] }}</button>
                    @endif
                @endforeach
            </div>
            @if($selectedStudent->status !== \App\Models\Feedback::STATUS_CLOSED)
                <div class="d-flex justify-content-center">
                    <div class="d-flex align-items-center mt-2">
                        <label for="assignUser" class="text-uppercase fw-bold me-2 text-nowrap">Assigned to</label>
                        <select wire:model="assignedUser" id="assignUser" class="form-select form-select-sm me-2">
                            <option value=""></option>
                            @foreach($internalUsers as $user)
                                <option value="{{ $user->id }}">{{ $user->id }} {{ $user->full_name }}</option>
                            @endforeach
                        </select>
                        <button wire:click="assignStudent" class="btn btn-sm btn-dark">Save</button>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif
