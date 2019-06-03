<?php

use Illuminate\Database\Seeder;

class MotivosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('motivo_contactos')->delete();
        DB::table('motivo_contactos')->insert(
            [
                [
                    'id' => 1,
                    'correo' => 'admin@admin.com',
                    'nombre' => 'Motivo 1',
                    'orden' => 1,

                ],
                [
                    'id' => 2,
                    'correo' => 'admin@admin.com',
                    'nombre' => 'Motivo 2',
                    'orden' => 2,
                ]
                ,
                [
                    'id' => 3,
                    'correo' => 'admin@admin.com',
                    'nombre' => 'Motivo 3',
                    'orden' => 3,
                ]
                ,
                [
                    'id' => 4,
                    'correo' => 'admin@admin.com',
                    'nombre' => 'Motivo 4',
                    'orden' => 4,
                ]
                
            ]
        );
    }
}
