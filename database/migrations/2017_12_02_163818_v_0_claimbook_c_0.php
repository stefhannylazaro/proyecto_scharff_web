<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class V0ClaimbookC0 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claimbooks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_reclamo');
            $table->string('nombre')->nullable();
            $table->integer('ubigeo_id')->unsigned()->nullable();
            $table->foreign('ubigeo_id')
                ->references('id')->on('ubigeos');
            $table->string('direccion')->nullable();
            $table->string('documento')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->text('descripcion_menor_edad')->nullable();
            $table->enum('bien_contratado',['Producto', 'Servicio'])->nullable();
            $table->string('monto_reclamado')->nullable();
            $table->text('descripcion_bien_contratado')->nullable();

            $table->enum('tipo_reclamo',['Reclamo', 'Queja'])->nullable();
            $table->text('detalle_reclamo')->nullable();
            $table->text('pedido_reclamo')->nullable();

            $table->text('observacion')->nullable();
            $table->dateTimeTz('fecha_reclamo')->nullable();

            $table->boolean('estado_reclamo')->default(false);
            $table->text('session_id');

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
        Schema::dropIfExists('claimbooks');
    }
}
