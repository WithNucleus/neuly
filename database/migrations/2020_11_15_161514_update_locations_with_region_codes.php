<?php

use App\Models\Location;
use Illuminate\Database\Migrations\Migration;
use Symfony\Component\Console\Output\ConsoleOutput;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $us_regions = [
            'Virginia' => 'US-VA',
            'Pennsylvania' => 'US-PA',
            'Tennessee' => 'US-TN',
            'West Virginia' => 'US-WV',
            'Nevada' => 'US-NV',
            'Texas' => 'US-TX',
            'New Hampshire' => 'US-NH',
            'New York' => 'US-NY',
            'Hawaii' => 'US-HI',
            'Vermont' => 'US-VT',
            'New Mexico' => 'US-NM',
            'North Carolina' => 'US-NC',
            'North Dakota' => 'US-ND',
            'Nebraska' => 'US-NE',
            'Louisiana' => 'US-LA',
            'South Dakota' => 'US-SD',
            'District of Columbia' => 'US-DC',
            'Delaware' => 'US-DE',
            'Florida' => 'US-FL',
            'Connecticut' => 'US-CT',
            'Washington' => 'US-WA',
            'Kansas' => 'US-KS',
            'Wisconsin' => 'US-WI',
            'Oregon' => 'US-OR',
            'Kentucky' => 'US-KY',
            'Maine' => 'US-ME',
            'Ohio' => 'US-OH',
            'Oklahoma' => 'US-OK',
            'Idaho' => 'US-ID',
            'Wyoming' => 'US-WY',
            'Utah' => 'US-UT',
            'Indiana' => 'US-IN',
            'Illinois' => 'US-IL',
            'Alaska' => 'US-AK',
            'New Jersey' => 'US-NJ',
            'Colorado' => 'US-CO',
            'Maryland' => 'US-MD',
            'Massachusetts' => 'US-MA',
            'Alabama' => 'US-AL',
            'Missouri' => 'US-MO',
            'Minnesota' => 'US-MN',
            'California' => 'US-CA',
            'Iowa' => 'US-IA',
            'Michigan' => 'US-MI',
            'Georgia' => 'US-GA',
            'Arizona' => 'US-AZ',
            'Montana' => 'US-MT',
            'Mississippi' => 'US-MS',
            'South Carolina' => 'US-SC',
            'Rhode Island' => 'US-RI',
            'Arkansas' => 'US-AR',
        ];

        $locations = Location::where('country', 'USA')->get();

        $output = new ConsoleOutput();

        foreach ($locations as $location) {
            if (array_key_exists($location->region, $us_regions)) {
                $location->region_code = $us_regions[$location->region];
                $location->save();
                $output->writeln($location->name.' region updated');
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
};
