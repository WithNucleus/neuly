<?php

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->string('name')->unique()->primary();
            $table->string('native_name');
            $table->string('alpha2code', 2);
            $table->string('alpha3code', 3);
            $table->string('capital');
            $table->string('region');
            $table->string('subregion');
            $table->integer('population')->unsigned();
            $table->double('area')->unsigned()->nullable(true);
            $table->json('timezones');
            $table->json('currencies');
            $table->json('languages');
            $table->timestampsTz();
        });

        $http = new Client();
        $response = $http->get('https://restcountries.eu/rest/v2/all');

        $countries = json_decode($response->getBody(), true);

        foreach($countries as $country) {
            DB::table('countries')->insert(
                array(
                    'name' => $country['name'],
                    'native_name' => $country['nativeName'],
                    'alpha2code' => $country['alpha2Code'],
                    'alpha3code' => $country['alpha3Code'],
                    'capital' => $country['capital'],
                    'region' => $country['region'],
                    'subregion' => $country['subregion'],
                    'population' => $country['population'],
                    'area' => $country['area'],
                    'timezones' => json_encode($country['timezones']),
                    'currencies' => json_encode($country['currencies']),
                    'languages' => json_encode($country['languages']),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                )
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
