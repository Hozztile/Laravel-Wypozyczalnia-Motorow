<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('marka');
            $table->string('model');
            $table->string('pojemnosc');
            $table->string('moc');
            $table->string('waga');
            $table->string('zdj');
            $table->boolean('dostep');
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
        Schema::dropIfExists('moto');
    }
}
