<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGobuyAlerta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('gobuy_alertas', function (Blueprint $table) {
          $table->increments('id');
          $table->string('alerta_descripcion')->nullable();
          $table->date('alerta_fecha')->nullable();
          $table->unsignedInteger('estado')->default(1);
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
      Schema::dropIfExists('gobuy_alertas');
    }
}
