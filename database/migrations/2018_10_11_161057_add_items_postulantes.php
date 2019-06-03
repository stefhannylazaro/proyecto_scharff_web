<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItemsPostulantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('postulantes', function($table) {
          $table->integer('dispositivo')->nullable();
          $table->string('dni')->nullable();
          $table->string('sexo')->nullable();
          $table->string('direccion')->nullable();
          $table->string('distrito')->nullable();
          $table->string('estilo')->nullable();
          $table->string('zona')->nullable();
          $table->string('placa')->nullable();
          $table->string('banco')->nullable();
          $table->string('numero_cuenta')->nullable();
          $table->string('cci')->nullable();
          $table->string('ficha_datos')->nullable();
          $table->string('validacion_datos')->nullable();
          $table->text('motivo_rechazo')->nullable();
          $table->smallInteger('nota_evaluacion')->nullable();
          $table->string('termino_condiciones')->nullable();
          $table->string('estado')->nullable();
          $table->string('capacidad')->nullable();
          $table->smallInteger('calificacion_estrella')->nullable();
          $table->string('clave')->nullable();
          $table->string('mochila')->nullable();
          $table->string('pos')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('postulantes', function($table) {
        $table->dropColumn('dispositivo');
        $table->dropColumn('dni');
        $table->dropColumn('sexo');
        $table->dropColumn('direccion');
        $table->dropColumn('distrito');
        $table->dropColumn('estilo');
        $table->dropColumn('zona');
        $table->dropColumn('placa');
        $table->dropColumn('banco');
        $table->dropColumn('numero_cuenta');
        $table->dropColumn('cci');
        $table->dropColumn('ficha_datos');
        $table->dropColumn('validacion_datos');
        $table->dropColumn('motivo_rechazo');
        $table->dropColumn('nota_evaluacion');
        $table->dropColumn('termino_condiciones');
        $table->dropColumn('estado');
        $table->dropColumn('capacidad');
        $table->dropColumn('calificacion_estrella');
        $table->dropColumn('clave');
        $table->dropColumn('mochila');
        $table->dropColumn('pos');
      });
    }
}
