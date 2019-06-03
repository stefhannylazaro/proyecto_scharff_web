<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromocionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promociones', function (Blueprint $table) {
            $table->increments('promocion_id');
            $table->timestamps();
            $table->string('promocion_nombre')->nullable();
            $table->unsignedSmallInteger('tipo_id')->nullable();
            $table->string('promocion_atributos')->nullable();
            $table->unsignedInteger('promocion_descuento_flat')->nullable();
            $table->unsignedTinyInteger('promocion_descuento_porcentaje')->nullable();
            $table->date('promocion_fecha_inicio')->nullable();
            $table->date('promocion_fecha_fin')->nullable();
            $table->unsignedSmallInteger('promocion_cupon_bool')->nullable();
            $table->unsignedSmallInteger('promocion_prioridad')->nullable();
            $table->string('promocion_cualesservicios')->nullable();
            $table->unsignedInteger('promocion_transacciones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promociones');
    }





    //
    // promociones
    //   promocion_id ()
    //   tipo_id(array)
    //   promocion_nombre
    //   promocion_atributos
    //   promocion_descuento_flat
    //   promocion_descuento_porcentaje
    //   promocion_fecha_inicio
    //   promocion_cupon_bool (int min)
    //   promocion_prioridad
    //   promocion_cualesservicios(array)
    //   promocion_transacciones
    //
    //
    // promociones_usuarios
    //   promocion_id
    //   usuario_id
    //   cupon_id
    //
    //
    //
    // cupon
    //   cupon_id
    //   promocion_id
    //   cupon_numero_usos
    //   cupon_texto
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //
    // cupon_personas
    //   usuario_id
    //   cupon_id
    //
    //
    // beneficio
    //   beneficio_id
    //   promocion_id
    //   nombre
    //
    //
    //
    //
    //
    //   Estos beneficios serán mostrados en el admin para que apenas ingresen sepan de
    //   que beneficios pueden hacer uso.













}
