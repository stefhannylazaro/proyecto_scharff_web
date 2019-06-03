<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReservaLokers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('reserva_lockers', function (Blueprint $table) {
          $table->increments('id');
          $table->tinyInteger('estado')->unsigned()->default(1);
          $table->dateTimeTz('fecha_entrega')->nullable();
          $table->string('contacto')->nullable();
          $table->string('dni',10)->nullable();
          $table->string('correo',30)->nullable();
          $table->string('celular',20)->nullable();
          $table->dateTimeTz('fecha_recojo')->nullable();
          $table->decimal('total_pagado')->nullable();
          $table->string('size',20)->nullable();
          $table->string('articulo')->nullable();
          $table->tinyInteger('tarjeta_id')->unsigned()->nullable();
          $table->integer('locker_id')->unsigned()->nullable();
          $table->string('direccion')->nullable();
          $table->integer('user_id')->unsigned();
          $table->timestamps();
          $table->foreign('user_id')
              ->references('id')->on('users');
      });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserva_lockers');
    }
}
