<?php
    function howManyColoredCells($phase) {
        if ($phase === 'Early Phase 1' OR $phase === 'Phase 0') {
            $count = 1;
        } elseif ($phase === 'Phase 1') {
            $count = 2;
        } elseif ($phase === 'Phase 1|Phase 2' OR $phase === 'Phase 2') {
            $count = 3;
        } elseif ($phase === 'Phase 2|Phase 3' OR $phase === 'Phase 3') {
            $count = 4;
        } elseif ($phase === 'Phase 4') {
            $count = 5;
        } else {
            $count = 0;
        }
        return $count;
    }
?>

<table class="table table-bordered bg-white shadow-sm">
    <thead class="thead-dark lead-smaller">
    <tr>
        <th>Focus / Condition</th>
        <th>Status</th>
        <th>Early Phase 1</th>
        <th>Phase 1</th>
        <th>Phase 2</th>
        <th>Phase 3</th>
        <th>Phase 4</th>
        <th>Approval</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($companies as $companyWithTrials)
        <tr>
            <th colspan="8" class="border-info bg-info text-uppercase font-size-large">
                {{ $companyWithTrials[0]->company_name }}
            </th>
        </tr>
        @foreach ($companyWithTrials as $clinicaltrial)
            <tr>
                <td>
                    <a href="{{ route('discover.clinicaltrials.show', $clinicaltrial->slug) }}">
                        <span class="truncate-this-long">{{ $clinicaltrial->focus_name }} &ndash; {{ $clinicaltrial->conditions }}</span>
                    </a>
                </td>
                <td>
                    {{ $clinicaltrial->status }}
                </td>
                    <?php
                    $colored_cells = howManyColoredCells($clinicaltrial->phase);
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
