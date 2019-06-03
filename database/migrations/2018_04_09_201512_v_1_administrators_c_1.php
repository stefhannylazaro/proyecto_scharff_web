<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class V1AdministratorsC1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('administrators', function($table) {
            $table->integer('perfil_id')->unsigned()->nullable();
            $table->foreign('perfil_id')
                ->references('id')->on('perfil')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('administrators', function($table) {
            $table->dropForeign(['perfil_id']);
            $table->dropColumn('perfil_id');
        });
    }
}
