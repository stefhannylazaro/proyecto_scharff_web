<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMensajeStaffClienteOrdernToMotivo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('motivo_contactos', function($table) {  
            $table->text('mensaje_personalizado_staff')->nullable();
            $table->text('mensaje_personalizado_cliente')->nullable();
            $table->integer('orden')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('motivo_contactos', function($table) {
            $table->dropColumn('mensaje_personalizado_staff');
            $table->dropColumn('mensaje_personalizado_cliente');
            $table->dropColumn('orden');
        });
    }
}
