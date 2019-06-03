<?php

use Illuminate\Database\Seeder;

class OptionsGobuyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('opciones')->insert(
          [

              [
                  'id' => 21,
                  'nombre' => 'Gobuy dirección',
                  'slug' => 'gobuy_place',
                  'valor' => "8329 NW 66th St.",
                  'tipo' => 'textfield',
                  "options" => ''
              ],
              [
                  'id' => 22,
                  'nombre' => 'Gobuy city',
                  'slug' => 'gobuy_place',
                  'valor' => "Miami, Fl 33166",
                  'tipo' => 'textfield',
                  "options" => ''
              ],
              [
                  'id' => 23,
                  'nombre' => 'Gobuy teléfono',
                  'slug' => 'gobuy_phone',
                  'valor' => "305-639.2626",
                  'tipo' => 'textfield',
                  "options" => ''
              ]

          ]

      );
    }
}
