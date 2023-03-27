<?php

use App\Models\Country;
use App\Models\Location;
use Illuminate\Database\Migrations\Migration;
use Symfony\Component\Console\Output\ConsoleOutput;

class UpdateLocationsTableWithCountryData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $locations = Location::all();
        $countries = Country::pluck('alpha2code', 'name')->toArray();
        $output = new ConsoleOutput();

        foreach ($locations as $location) {
            if (array_key_exists($location->country, $countries)) {
                $location->alpha2code = $countries[$location->country];
                $location->save();
            } else {
                $output->writeln($location->name.' alpha2code not found');
            }
        }
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
