<div class="home-request-research">
    <div class="container text-center">
        <h2 class="large-title mb-5 max-width-1000 mx-auto text-white">Need Psychedelics Research Done for Your Organization?</h2>
        <button data-bs-toggle="modal" data-bs-target="#research-request-modal" class="btn btn-accent btn-lg btn-cta">Request a Research Report</button>
    </div>
    <div class="modal fade" id="research-request-modal" tabindex="-1" aria-labelledby="research-request-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
{{--                    <div class="modal-title h4" id="research-request-modal-label">Request a Research Report</div>--}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="pb-5">
                        <div class="max-width-300 mx-auto mb-4">
                            @include('navbars.neuly-research-logo')
                        </div>
                        <div class="h2 text-uppercase fw-bold mb-2 text-center text-body-emphasis">
                            Request a Research Report
                        </div>
                        <div class="max-width-500 mx-auto">
                            <livewire:public.opt-ins.research-requests.general requestType="{{ \App\Models\ResearchRequest::TYPE_REPORT_REQUEST }}" titleMessage="Fill out the form below with your request for psychedelics research and/or data." />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
