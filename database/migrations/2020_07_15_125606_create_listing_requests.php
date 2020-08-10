<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->enum('type', ['event', 'investor', 'organization', 'person', 'other']);
            $table->boolean('is_update');
            $table->json('entity_data');
            $table->string('entity_name');
            $table->text('comment')->nullable();
            $table->bigInteger('to_update_id')->nullable();
            $table->enum('status', ['open', 'accepted', 'declined'])->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listing_requests');
    }
}
