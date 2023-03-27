<?php

use App\Models\Country;
use App\Models\Location;
use Illuminate\Database\Migrations\Migration;
use Symfony\Component\Console\Output\ConsoleOutput;

class ChangeCountryNameRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $country_names = [
            'United States of America' => 'USA',
            'United Kingdom of Great Britain and Northern Ireland' => 'United Kingdom',
            'Czech Republic' => 'Czechia',
            'Korea (Republic of)' => 'South Korea',
            'Palestine, State of' => 'Palestine',
            'Iran (Islamic Republic of)' => 'Iran',
            'Viet Nam' => 'Vietnam',
            'Tanzania, United Republic of' => 'Tanzania',
            'Republic of Kosovo' => 'Kosovo',
        ];

        $output = new ConsoleOutput();

        foreach ($country_names as $old_name => $new_name) {
            $country = Country::where('name', $old_name)->first();
            if ($country) {
                $country->name = $new_name;
                $country->save();
                $output->writeln($new_name.' successfully changed');
            } else {
                $output->writeln($new_name.' failed to change');
            }
        }

        $uk_locations = Location::where('country', 'UK')->get();

        foreach ($uk_locations as $uk_location) {
            $uk_location->country = 'United Kingdom';
            $old_name = $uk_location->name;
            $new_name = str_replace('UK', 'United Kingdom', $old_name);
            $uk_location->name = $new_name;
            $uk_location->save();
            $output->writeln($uk_location->name.' changed UK name');
        }
    }
}
