<?php

use Illuminate\Database\Seeder;

class PerfilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfil')->delete();
        DB::table('perfil')->insert(
            [
                [

                    'nombre' => 'Administrador',
                    'created_at' => now()
                ]

            ]
        );
    }
}

//php artisan db:seed --class=AccionTableSeeder
//php artisan db:seed --class=FaqSeeder
