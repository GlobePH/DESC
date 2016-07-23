<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutboundStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outbound_status', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cluster_id');
            $table->string('reference_id', 255);
            $table->string('status_code', 50);
            $table->string('status_message', 255);
            $table->timestamp('time_notified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('outbound_status');
    }
}
