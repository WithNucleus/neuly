<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Location;
use Symfony\Component\Console\Output\ConsoleOutput;

class AddRegionCodesToCountriesRoundTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $canada_regions = [
            'Northwest Territories' => 'CA-NT',
            'Nunavut' => 'CA-NU',
            'Nova Scotia' => 'CA-NS',
            'British Columbia' => 'CA-BC',
            'Saskatchewan' => 'CA-SK',
            'Quebec' => 'CA-QC',
            'Prince Edward Island' => 'CA-PE',
            'Manitoba' => 'CA-MB',
            'Yukon' => 'CA-YT',
            'New Brunswick' => 'CA-NB',
            'Newfoundland and Labrador' => 'CA-NL',
            'Ontario' => 'CA-ON',
            'Alberta' => 'CA-AB',
        ];

        $canada_locations = Location::where('country', 'Canada')->get();
        $this->updateLocations('Canada', $canada_locations, $canada_regions);

        $australia_regions = [
            'Australian Capital Territory' => 'AU-ACT',
            'Western Australia' => 'AU-WA',
            'Tasmania' => 'AU-TAS',
            'Victoria' => 'AU-VIC',
            'Northern Territory' => 'AU-NT',
            'Queensland' => 'AU-QLD',
            'South Australia' => 'AU-SA',
            'New South Wales' => 'AU-NSW',
        ];

        $australia_locations = Location::where('country', 'Australia')->get();
        $this->updateLocations('Australia', $australia_locations, $australia_regions);

        $netherlands_regions = [
            'Overijssel' => 'NL-OV',
            'Friesland' => 'NL-FR',
            'Utrecht' => 'NL-UT',
            'Gelderland' => 'NL-GE',
            'Flevoland' => 'NL-FL',
            'North Holland' => 'NL-NH',
            'Zeeland' => 'NL-ZE',
            'South Holland' => 'NL-ZH',
            'Groningen' => 'NL-GR',
            'Drenthe' => 'NL-DR',
            'North Brabant' => 'NL-NB',
            'Limburg' => 'NL-LI',
        ];

        $netherlands_locations = Location::where('country', 'Netherlands')->get();
        $this->updateLocations('Netherlands', $netherlands_locations, $netherlands_regions);

        $germany_regions = [
            'Berlin' => 'DE-BE',
            'Sachsen-Anhalt' => 'DE-ST',
            'Rheinland-Pfalz' => 'DE-RP',
            'Brandenburg' => 'DE-BB',
            'Niedersachsen' => 'DE-NI',
            'Mecklenburg-Vorpommern' => 'DE-MV',
            'Thüringen' => 'DE-TH',
            'Baden-Württemberg' => 'DE-BW',
            'Hamburg' => 'DE-HH',
            'Schleswig-Holstein' => 'DE-SH',
            'Nordrhein-Westfalen' => 'DE-NW',
            'Sachsen' => 'DE-SN',
            'Bremen' => 'DE-HB',
            'Saarland' => 'DE-SL',
            'Bayern' => 'DE-BY',
            'Hessen' => 'DE-HE',
        ];

        $germany_locations = Location::where('country', 'Germany')->get();
        $this->updateLocations('Germany', $germany_locations, $germany_regions);

        $france_regions = [
            'Guyane française' => 'FR-GF',
            'Corse' => 'FR-H',
            'Centre' => 'FR-F',
            'Bretagne' => 'FR-E',
            'Bourgogne-Franche-Comté' => 'FR-X1',
            'Martinique' => 'FR-MQ',
            'Mayotte' => 'FR-YT',
            'Alsace-Champagne-Ardenne-Lorraine' => 'FR-X4',
            'Occitanie' => 'FR-X5',
            'Nord-Pas-de-Calais-Picardie' => 'FR-X6',
            'Auvergne-Rhône-Alpes' => 'FR-X7',
            'Normandy' => 'FR-X3',
            'Pays de la Loire' => 'FR-R',
            'Guadeloupe' => 'FR-GP',
            "Provence-Alpes-Côte d'Azur" => 'FR-U',
            'Île-de-France' => 'FR-J',
            'Nouvelle-Aquitaine' => 'FR-X2',
            'Réunion' => 'FR-RE',
        ];

        $france_locations = Location::where('country', 'France')->get();
        $this->updateLocations('France', $france_locations, $france_regions);

        $uk_regions = [
            'Northern Ireland' => 'NIR',
            'Scotland' => 'SCT',
            'Wales' => 'WLS',
            'England' => 'ENG',
        ];

        $uk_locations = Location::where('country', 'United Kingdom')->get();
        $this->updateLocations('United Kingdom', $uk_locations, $uk_regions);

    }

    private function updateLocations($country, $locations, $regions)
    {
        $output = new ConsoleOutput();
        $output->writeln('----- ' . "\n" . $country . "\n" . '-----');

        foreach ($locations as $location) {
            if (array_key_exists($location->region, $regions)) {
                $location->region_code = $regions[$location->region];
                $location->save();
                $output->writeln($location->name . ' region updated');
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
