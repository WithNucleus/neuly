<?php

use App\Models\Location;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Output\ConsoleOutput;

class RemoveUnusedLocationRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $output = new ConsoleOutput();
        $total_deleted = 0;
        $locations = Location::withCount(['companies', 'people', 'investors', 'jobs', 'events', 'clinicaltrials'])->get();

        foreach ($locations as $location) {
            $total = $location->companies_count +
                     $location->people_count +
                     $location->investors_count +
                     $location->jobs_count +
                     $location->events_count +
                     $location->clinicaltrials_count;

            if ($total == 0) {
                $total_deleted++;
                $location->delete();
                Log::info('Deleted '.$location->name);
            }
        }

        $output->writeln($total_deleted.' locations removed');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // no need
    }
}
