<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class V1ClaimbookC0 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('claimbooks', function (Blueprint $table) {
            $table->enum('linea_servicio', [
                'distribución-nacional',
                'aduanas',
                'carga',
                'almacenes',
                'envios-internacionales',
                'scharff-express-pickapp',
                'scharff-stop-lockers'])->after('id');
            $table->enum('tipo_moneda',['Soles', 'Dólares'])->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('claimbooks', function (Blueprint $table) {
            $table->dropColumn('linea_servicio');
            $table->dropColumn('tipo_moneda');
        });

    }
}
