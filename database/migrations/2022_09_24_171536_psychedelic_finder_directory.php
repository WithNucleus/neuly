<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $directory = \App\Models\Directory::create([
            'name' => 'Psychedelic Finder',
            'url_prefix' => 'https://psychedelicfinder.test/listings/',
        ]);

        $bookableIds = \App\Models\BookableListing::practitioners()->pluck('id')->toArray();
        $directory->bookableListings()->sync($bookableIds);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
