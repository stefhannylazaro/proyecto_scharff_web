<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBannerSlugTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement("ALTER TABLE banners CHANGE COLUMN slug slug ENUM(

        'home',
        'aduanas',
        'almacenes',
        'carga',
        'distribucion_nacional',
        'domestica',
        'empresa',
        'scharff_lab',
        'paraTi',
        'scharff_express',
        'scharff_stop'







      )  NOT NULL DEFAULT 'home'");


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
