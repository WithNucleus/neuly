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
        $countries = [
            'Canada' => [
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
                ],
            'Australia' => [
                'Australian Capital Territory' => 'AU-ACT',
                'Western Australia' => 'AU-WA',
                'Tasmania' => 'AU-TAS',
                'Victoria' => 'AU-VIC',
                'Northern Territory' => 'AU-NT',
                'Queensland' => 'AU-QLD',
                'South Australia' => 'AU-SA',
                'New South Wales' => 'AU-NSW',
            ],
            'Netherlands' => [
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
            ],
            'Germany' => [
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
            ],
            'France' => [
                'French Guiana' => 'FR-GF',
                'Corsica' => 'FR-H',
                'Centre' => 'FR-F',
                'Brittany' => 'FR-E',
                'Bourgogne-Franche-Comté' => 'FR-X1',
                'Martinique' => 'FR-MQ',
                'Mayotte' => 'FR-YT',
                'Grand Est' => 'FR-X4',
                'Occitanie' => 'FR-X5',
                'Hauts-de-France' => 'FR-X6',
                'Auvergne-Rhône-Alpes' => 'FR-X7',
                'Normandy' => 'FR-X3',
                'Pays de la Loire' => 'FR-R',
                'Guadeloupe' => 'FR-GP',
                "Provence-Alpes-Côte d'Azur" => 'FR-U',
                'Île-de-France' => 'FR-J',
                'Nouvelle-Aquitaine' => 'FR-X2',
                'Réunion' => 'FR-RE',
            ],
            'United Kingdom' => [
                'Northern Ireland' => 'NIR',
                'Scotland' => 'SCT',
                'Wales' => 'WLS',
                'England' => 'ENG',
            ],
            'Austria' => [
                'Vorarlberg' => 'AT-8',
                'Vienna' => 'AT-9',
                'Upper Austria' => 'AT-4',
                'Salzburg' => 'AT-5',
                'Styria' => 'AT-6',
                'Tyrol' => 'AT-7',
                'Burgenland' => 'AT-1',
                'Carinthia' => 'AT-2',
                'Lower Austria' => 'AT-3',
            ],
            'Belgium' => [
                'West Flanders' => 'BE-VWV',
                'Antwerp' => 'BE-VAN',
                'Luxembourg' => 'BE-WLX',
                'Walloon Brabant' => 'BE-WBR',
                'Flemish Brabant' => 'BE-VBR',
                'East Flanders' => 'BE-VOV',
                'Liège' => 'BE-WLG',
                'Limburg' => 'BE-VLI',
                'Hainaut' => 'BE-WHT',
                'Namur' => 'BE-WNA',
                'Brussels' => 'BE-BRU',
            ],
        ];

        foreach($countries as $country => $regions) {
            $this->findLocationsToUpdate($regions, $country);
        }

    }

    private function findLocationsToUpdate(array $regions, string $country)
    {
        $locations = Location::where('country', $country)->get();

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
