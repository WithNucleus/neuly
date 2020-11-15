<?php
    function howManyColoredCells($phase) {
        if ($phase == 0 OR $phase == '') {
            $count = 0;
        } else {
            $count = $phase;
        }
        return $count;
    }
?>

<div id="resizable-fullscreen-table-container">
    <button id="close-full-screen-table" class="btn d-none mb-3 btn-dark text-uppercase"><i class="fas fa-times"></i> Close</button>
    <div class="position-relative">
        <table class="table bg-white mb-0" id="clinical-trial-tracker">
            <thead class="thead-dark">
            <tr>
                <th class="text-no-wrap sticky-top">Focus / Condition</th>
                <th class="text-no-wrap sticky-top">Status</th>
                <th class="size-phase text-no-wrap sticky-top">Early Phase 1</th>
                <th class="size-phase text-no-wrap sticky-top">Phase 1</th>
                <th class="size-phase text-no-wrap sticky-top">Phase 2</th>
                <th class="size-phase text-no-wrap sticky-top">Phase 3</th>
                <th class="size-phase text-no-wrap sticky-top">Phase 4</th>
                <th class="size-phase text-no-wrap sticky-top">Approval</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($companies as $companyWithTrials)
                <tr>
                    <td colspan="8" class="border-info bg-info text-uppercase">
                        <a href="{{ route('discover.organizations.show', $companyWithTrials[0]->company_slug) }}" class="text-dark">{{ $companyWithTrials[0]->company_name }}</a>
                    </td>
                </tr>
                @foreach ($companyWithTrials as $clinicaltrial)
                    <tr>
                        <td>
                            <a href="{{ route('discover.clinicaltrials.show', $clinicaltrial->slug) }}">
                                <span class="truncate-this-long">{{ $clinicaltrial->focus_name }} &ndash; {{ $clinicaltrial->conditions }}</span>
                            </a>
                        </td>
                        <td class="text-no-wrap">
                            {{ $clinicaltrial->status }}
                        </td>
                        <?php
                        $colored_cells = howManyColoredCells($clinicaltrial->phase_integer);
                        $white_cells = 6 - $colored_cells;

                        for ($count = 0 ; $count < $colored_cells; $count++) {
                            echo '<td class="bg-primary"></td>';
                        }

                        for ($count = 0 ; $count < $white_cells; $count++) {
                            echo '<td></td>';
                        }
                        ?>
                    </tr>
                @endforeach
            @empty
                <td colspan="8">No clinical trials match your criteria</td>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
