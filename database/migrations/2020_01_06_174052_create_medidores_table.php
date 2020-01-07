<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedidoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medidores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cuenta');
            $table->string('numero_medidor');
            $table->string('uso');
            $table->string('tarifa');
            $table->string('lectura');
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
        Schema::dropIfExists('medidores');
    }
}
