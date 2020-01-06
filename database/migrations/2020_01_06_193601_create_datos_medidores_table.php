<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosMedidoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_medidores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('periodo');
            $table->string('dias');
            $table->string('lectura_anterior');
            $table->string('lectura_actual');
            $table->unsignedBigInteger('medidor_id');
            $table->timestamps();
            $table->foreign('medidor_id')->references('id')->on('medidores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_medidores');
    }
}
