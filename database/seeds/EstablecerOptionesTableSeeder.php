<?php

use Illuminate\Database\Seeder;

class EstablecerOptionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('opciones')->delete();
      DB::table('opciones')->insert(
          [
              [
                  'id' => 1,
                  'nombre' => 'Mostrar popup en Home',
                  'slug' => 'mostrar_popup',
                  'valor' => 0,
                  'tipo' => 'checkbox',
                  "options" => ''
              ],
              [
                  'id' => 2,
                  'nombre' => 'RUC',
                  'slug' => 'ruc',
                  'valor' => "",
                  'tipo' => 'textfield',
                  "options" => ''
              ],
              [
                  'id' => 3,
                  'nombre' => 'Razon social',
                  'slug' => 'razon_social',
                  'valor' => "",
                  'tipo' => 'textfield',
                  "options" => ''
              ],
              [
                  'id' => 4,
                  'nombre' => 'Preferencia de facturación',
                  'slug' => 'preferencia_facturacion',
                  'valor' => 0,
                  'tipo' => 'opcion',
                  "options" => '{"opciones":["Factura"]}',
              ],
              [
                  'id' => 5,
                  'nombre' => 'Tipo de scharffer preferido',
                  'slug' => 'tipo_scharffer_preferido',
                  'valor' => 0,
                  'tipo' => 'opcion',
                  'options' => '{"opciones":["Bicicleta","Moto","Auto"]}'
              ],
              [
                  'id' => 6,
                  'nombre' => 'Notificar postulaciones al correo:',
                  'slug' => 'postulantes_email_admin',
                  'valor' => "",
                  'tipo' => 'textfield',
                  "options" => ''
              ],
              [
                  'id' => 7,
                  'nombre' => 'Notificar reclamos al correo:',
                  'slug' => 'reclamos_email_admin',
                  'valor' => "",
                  'tipo' => 'textfield',
                  "options" => ''
              ]

          ]

      );
    }
}
