<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTicketsLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ticket_id');
            $table->string('latitude', 100);
            $table->string('longitude', 100);
            $table->string('location_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ticket_locations');
    }
}
