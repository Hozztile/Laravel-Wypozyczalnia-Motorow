<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWypoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wypo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_moto');
            $table->integer('id_user');
            $table->date('wypo_od');
            $table->date('wypo_do');
            $table->integer('aktywne');
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
        Schema::dropIfExists('wypo');
    }
}
