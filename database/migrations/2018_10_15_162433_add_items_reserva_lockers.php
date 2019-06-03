<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItemsReservaLockers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('reserva_lockers', function($table) {
          $table->integer('id_op_boxeway')->nullable();
          $table->smallInteger('plazo_reserva')->nullable();
          $table->string('tipo_retiro')->nullable();
          $table->string('direccion_destino')->nullable();
          $table->string('provincia_destino')->nullable();
          $table->string('departamento_destino')->nullable();
          $table->date('fecha_vencimiento_entrega')->nullable();
          $table->date('fecha_vencimiento_recojo')->nullable();
          $table->string('medio_pago')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('reserva_lockers', function($table) {
        $table->dropColumn('id_op_boxeway');
        $table->dropColumn('plazo_reserva');
        $table->dropColumn('tipo_retiro');
        $table->dropColumn('direccion_destino');
        $table->dropColumn('provincia_destino');
        $table->dropColumn('departamento_destino');
        $table->dropColumn('fecha_vencimiento_entrega');
        $table->dropColumn('fecha_vencimiento_recojo');
        $table->dropColumn('medio_pago');
      });
    }
}
