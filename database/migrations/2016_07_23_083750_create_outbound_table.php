<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutboundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outbound', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cluster_id');
            $table->string('reference_id', 255);
            $table->integer('sms_type');
            $table->string('number', 12);
            $table->string('message', 480);
            $table->string('request_id', 480);
            $table->timestamp('time_prepared');
            $table->timestamp('time_delivered');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('outbound');
    }
}
