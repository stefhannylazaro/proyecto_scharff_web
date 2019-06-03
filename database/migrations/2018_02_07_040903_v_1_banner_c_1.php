<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class V1BannerC1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->enum('slug', [
                'home',
                'distribucion_nacional',
                'aduanas',
                'carga',
                'almacenes',
                'envios_internacionales',
                'scharff_express',
                'scharff_stop',
                'cotizador',
                'scharff_lab'])->default('home')->after('id');

            $table->text('url')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('url');
        });
    }
}
