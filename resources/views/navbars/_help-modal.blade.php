<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="h4 modal-title">Looking for something?</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-lg-7 order-lg-2">
                        <p class="fs-5 text-primary">Request some data, get some help, or give us feedback. We'd love to hear from you!</p>
                        <livewire:public.opt-ins.help-modal-opt-in />
                    </div>
                    <div class="col-12 col-lg-5 pe-lg-4 order-lg-1">
                        <div class="neuly-help-logo-item mb-3">
                            <button class="btn" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-research" aria-expanded="true"
                                    aria-controls="collapse-research">
                                @include('navbars.neuly-research-logo')
                            </button>
                            <div class="collapse show" id="collapse-research">
                                <div>
                                    <ul class="neuly-help-nav-list">
                                        @include('navbars._research')
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="neuly-help-logo-item mb-3">
                            <button class="btn" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-edu" aria-expanded="false"
                                    aria-controls="collapse-edu">
                                @include('navbars.neuly-edu-logo')
                            </button>
                            <div class="collapse" id="collapse-edu">
                                <div>
                                    <ul class="neuly-help-nav-list">
                                        @include('navbars._edu')
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="neuly-help-logo-item mb-3">
                            <button class="btn" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-care" aria-expanded="false"
                                    aria-controls="collapse-care">
                                @include('navbars.neuly-care-logo')
                            </button>
                            <div class="collapse" id="collapse-care">
                                <div>
                                    <ul class="neuly-help-nav-list">
                                        @include('navbars._care')
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
