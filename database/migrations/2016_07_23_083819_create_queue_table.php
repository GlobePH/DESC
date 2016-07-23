<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queue', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cluster_id');
            $table->string('reference_id', 255);
            $table->integer('sms_type');
            $table->string('number', 12);
            $table->string('message', 480);
            $table->integer('delivery');
            $table->string('request_id', 480);
            $table->timestamp('time_prepared');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::drop('queue');       
    }
}
