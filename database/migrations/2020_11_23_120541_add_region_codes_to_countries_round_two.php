<?php

use App\Models\Location;
use Illuminate\Database\Migrations\Migration;
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
                'Saxony-Anhalt' => 'DE-ST',
                'Rheinland-Pfalz' => 'DE-RP',
                'Brandenburg' => 'DE-BB',
                'Lower Saxony' => 'DE-NI',
                'Mecklenburg-Vorpommern' => 'DE-MV',
                'Thüringen' => 'DE-TH',
                'Baden-Württemberg' => 'DE-BW',
                'Hamburg' => 'DE-HH',
                'Schleswig-Holstein' => 'DE-SH',
                'North Rhine-Westphalia' => 'DE-NW',
                'Sachsen' => 'DE-SN',
                'Bremen' => 'DE-HB',
                'Saarland' => 'DE-SL',
                'Bavaria' => 'DE-BY',
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
            'China' => [
                'Jiangsu' => 'CN-32',
                'Guizhou' => 'CN-52',
                'Yunnan' => 'CN-53',
                'Chongqing' => 'CN-50',
                'Sichuan' => 'CN-51',
                'Shanghai' => 'CN-31',
                'Xizang' => 'CN-54',
                'Zhejiang' => 'CN-33',
                'Inner Mongol' => 'CN-15',
                'Shanxi' => 'CN-14',
                'Fujian' => 'CN-',
                'Tianjin' => 'CN-12',
                'Hebei' => 'CN-13',
                'Beijing' => 'CN-11',
                'Anhui' => 'CN-34',
                'Jiangxi' => 'CN-36',
                'Shandong' => 'CN-37',
                'Henan' => 'CN-41',
                'Hunan' => 'CN-43',
                'Hubei' => 'CN-42',
                'Guangxi' => 'CN-45',
                'Guangdong' => 'CN-44',
                'Hainan' => 'CN-46',
                'Xinjiang' => 'CN-65',
                'Ningxia' => 'CN-64',
                'Qinghai' => 'CN-63',
                'Gansu' => 'CN-62',
                'Shaanxi' => 'CN-61',
                'Heilongjiang' => 'CN-23',
                'Jilin' => 'CN-22',
                'Liaoning' => 'CN-21',
            ],
            'Italy' => [
                'Aosta Valley' => 'IT-23',
                'Piedmont' => 'IT-21',
                'Lombardy' => 'IT-25',
                'Tuscany' => 'IT-52',
                'Friuli-Venezia Giulia' => 'IT-36',
                'Liguria' => 'IT-42',
                'Emilia-Romagna' => 'IT-45',
                'Marche' => 'IT-57',
                'Trentino-Alto Adige' => 'IT-32',
                'Umbria' => 'IT-55',
                'Molise' => 'IT-67',
                'Veneto' => 'IT-34',
                'Abruzzo' => 'IT-65',
                'Lazio' => 'IT-62',
                'Apulia' => 'IT-75',
                'Basilicata' => 'IT-77',
                'Calabria' => 'IT-78',
                'Sicily' => 'IT-82',
                'Campania' => 'IT-72',
                'Sardegna' => 'IT-88',
            ],
            'Spain' => [
                'Navarra' => 'ES-NA',
                'Barcelona' => 'ES-B',
                'Castellón' => 'ES-CS',
                'Zamora' => 'ES-ZA',
                'Asturias' => 'ES-O',
                'Orense' => 'ES-OR',
                'Madrid' => 'ES-M',
                'Lérida' => 'ES-L',
                'Jaén' => 'ES-J',
                'Huelva' => 'ES-H',
                'Cuenca' => 'ES-CU',
                'Tarragona' => 'ES-T',
                'A Coruña' => 'ES-C',
                'Ávila' => 'ES-AV',
                'Alicante' => 'ES-A',
                'Ciudad Real' => 'ES-CR',
                'Córdoba' => 'ES-CO',
                'Valladolid' => 'ES-VA',
                'Santa Cruz de Tenerife' => 'ES-TF',
                'Zaragoza' => 'ES-Z',
                'Málaga' => 'ES-MA',
                'Almería' => 'ES-AL',
                'Ceuta' => 'ES-CE',
                'Islas Baleares' => 'ES-PM',
                'Álava' => 'ES-VI',
                'Cantabria' => 'ES-S',
                'Teruel' => 'ES-TE',
                'Cáceres' => 'ES-CC',
                'Palencia' => 'ES-P',
                'Pontevedra' => 'ES-PO',
                'Las Palmas' => 'ES-GC',
                'Gerona' => 'ES-GI',
                'Toledo' => 'ES-TO',
                'Murcia' => 'ES-MU',
                'Granada' => 'ES-GR',
                'Guadalajara' => 'ES-GU',
                'Albacete' => 'ES-AB',
                'Soria' => 'ES-SO',
                'Melilla' => 'ES-ML',
                'Lugo' => 'ES-LU',
                'Sevilla' => 'ES-SE',
                'Cádiz' => 'ES-CA',
                'Segovia' => 'ES-SG',
                'Burgos' => 'ES-BU',
                'Salamanca' => 'ES-SA',
                'Valencia' => 'ES-V',
                'León' => 'ES-LE',
                'Bizkaia' => 'ES-BI',
                'Huesca' => 'ES-HU',
                'La Rioja' => 'ES-LO',
                'Gipuzkoa' => 'ES-SS',
                'Badajoz' => 'ES-BA',
            ],
            'Switzerland' => [
                'Solothurn' => 'CH-SO',
                'Lucerne' => 'CH-LU',
                'Schaffhausen' => 'CH-SH',
                'Sankt Gallen' => 'CH-SG',
                'Uri' => 'CH-UR',
                'Neuchâtel' => 'CH-NE',
                'Basel-Stadt' => 'CH-BS',
                'Jura' => 'CH-JU',
                'Basel-Landschaft' => 'CH-BL',
                'Schwyz' => 'CH-SZ',
                'Bern' => 'CH-BE',
                'Nidwalden' => 'CH-NW',
                'Zug' => 'CH-ZG',
                'Fribourg' => 'CH-FR',
                'Zürich' => 'CH-ZH',
                'Valais' => 'CH-VS',
                'Vaud' => 'CH-VD',
                'Ticino' => 'CH-TI',
                'Thurgau' => 'CH-TG',
                'Obwalden' => 'CH-OW',
                'Aargau' => 'CH-AG',
                'Geneva' => 'CH-GE',
                'Appenzell Innerrhoden' => 'CH-AI',
                'Glarus' => 'CH-GL',
                'Graubünden' => 'CH-GR',
                'Appenzell Ausserrhoden' => 'CH-AR',
            ],
        ];

        foreach ($countries as $country => $regions) {
            $this->findLocationsToUpdate($regions, $country);
        }
    }

    private function findLocationsToUpdate(array $regions, string $country)
    {
        $locations = Location::where('country', $country)->get();

        $output = new ConsoleOutput();
        $output->writeln('----- '."\n".$country."\n".'-----');

        foreach ($locations as $location) {
            if (array_key_exists($location->region, $regions)) {
                $location->region_code = $regions[$location->region];
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
}
