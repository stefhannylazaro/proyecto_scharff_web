<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class V1PerfilAccionC0 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_accion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('perfil_id')->unsigned()->nullable();
            $table->foreign('perfil_id')
                ->references('id')->on('perfil')
                ->onDelete('cascade');
            $table->integer('accion_id')->unsigned()->nullable();
            $table->foreign('accion_id')
                ->references('id')->on('accion')
                ->onDelete('cascade');
            $table->smallInteger('estado')->default(1);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfil_accion');
    }
}
