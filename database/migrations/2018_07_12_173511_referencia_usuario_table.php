<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReferenciaUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('referencia_usuario', function (Blueprint $table) {
          $table->increments('id');
          $table->timestamps();
          $table->integer('referencia_id')->unsigned()->nullable();
          $table->integer('usuario_id')->unsigned()->nullable();
      });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
