<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $listings = \App\Models\BookableListing::where('image', '/storage/people/2756.png')->update(['image' => NULL]);
        $listings = \App\Models\BookableListing::where('image', '/storage/logos/alpine-health-and-wellness.png')->update(['image' => NULL]);
    }
};
