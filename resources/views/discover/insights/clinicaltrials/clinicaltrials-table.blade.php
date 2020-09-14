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

<style>
    .table-scroll-container {
        width: 100%;
        overflow-x: auto;
    }

    .table-scroll-container table th,
    .table-scroll-container table td {
        min-width: 100px;
    }
</style>

<div class="table-scroll-container">
    <table class="table table-bordered bg-white shadow-sm">
        <thead class="thead-dark">
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
        <tbody class="font-size-small">
        @forelse ($companies as $companyWithTrials)
            <tr>
                <th colspan="8" class="border-info bg-info text-uppercase">
                    {{ $companyWithTrials[0]->company_name }}
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
