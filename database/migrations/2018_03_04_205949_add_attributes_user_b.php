<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributesUserB extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('usuario_nombre')->nullable();
            $table->string('usuario_apellidos')->nullable();
            $table->string('usuario_movil')->nullable();
            $table->string('usuario_tipo')->nullable();
            $table->string('usuario_dni')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('usuario_nombre');
            $table->dropColumn('usuario_apellidos');
            $table->dropColumn('usuario_movil');
            $table->dropColumn('usuario_tipo');
            $table->dropColumn('usuario_dni');
      });
    }
}
