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

<div class="table-responsive">
    <table class="table table-bordered bg-white shadow-sm">
        <thead class="thead-dark">
        <tr>
            <th class="text-no-wrap">Focus / Condition</th>
            <th class="text-no-wrap">Status</th>
            <th class="text-no-wrap">Early Phase 1</th>
            <th class="text-no-wrap">Phase 1</th>
            <th class="text-no-wrap">Phase 2</th>
            <th class="text-no-wrap">Phase 3</th>
            <th class="text-no-wrap">Phase 4</th>
            <th class="text-no-wrap">Approval</th>
        </tr>
        </thead>
        <tbody class="font-size-small">
        @forelse ($companies as $companyWithTrials)
            <tr>
                <th colspan="8" class="border-info bg-info text-uppercase">
                    <a href="{{ route('discover.organizations.show', $companyWithTrials[0]->company_slug) }}" class="text-dark">{{ $companyWithTrials[0]->company_name }}</a>
                </th>
            </tr>
            @foreach ($companyWithTrials as $clinicaltrial)
                <tr>
                    <td>
                        <a href="{{ route('discover.clinicaltrials.show', $clinicaltrial->slug) }}">
                            <span class="truncate-this">{{ $clinicaltrial->focus_name }} &ndash; {{ $clinicaltrial->conditions }}</span>
                        </a>
                    </td>
                    <td>
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
