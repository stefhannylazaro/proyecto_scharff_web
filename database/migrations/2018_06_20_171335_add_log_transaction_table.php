<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLogTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('log_transaction', function (Blueprint $table) {
          $table->increments('id');
          $table->timestamps();
          $table->integer('customer_id')->nullable();
          $table->string('tipo_accion')->nullable();
          $table->string('trama_respuesta_culqi')->nullable();
      });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_transaction');
    }
}
