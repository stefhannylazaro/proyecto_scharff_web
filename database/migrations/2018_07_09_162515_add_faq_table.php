<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFaqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('faqs', function (Blueprint $table) {
          $table->increments('id');
          $table->timestamps();
          $table->string('categoria')->nullable();
          $table->string('pregunta')->nullable();
          $table->string('respuesta')->nullable();
          $table->string('extrainfo')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqs');
    }
}
