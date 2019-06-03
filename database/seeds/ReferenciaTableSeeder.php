<?php

use Illuminate\Database\Seeder;

class ReferenciaTableSeeder extends Seeder
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
                    'nombre' => '',

                ],
                [
                    'id' => 2,
                    'nombre' => '',
                ]


            ]
        );
    }
}
